<?php

	use PayPal\CoreComponentTypes\BasicAmountType;
	use PayPal\CoreComponentTypes\PayerInfoType;
	use PayPal\CoreComponentTypes\PersonNameType;
	use PayPal\EBLBaseComponents\AddressType;
	use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
	use PayPal\EBLBaseComponents\PaymentDetailsItemType;
	use PayPal\EBLBaseComponents\PaymentDetailsType;
	use PayPal\Service\PayPalAPIInterfaceServiceService;
	use PayPal\PayPalAPI\GetExpressCheckoutReq;
	use PayPal\PayPalAPI\GetExpressCheckoutRequestType;
	use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;
	use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
	use PayPal\EBLBaseComponents\DoExpressCheckoutPaymentRequestDetailsType;
	use PayPal\PayPalAPI\DoExpressCheckoutPaymentRequestType;
	use PayPal\PayPalAPI\DoExpressCheckoutPaymentReq;
	use PayPal\PayPalAPI\DoExpressCheckoutPayment;
	use PayPal\EBLBaseComponents\GetExpressCheckoutDetailsResponseType;
	
	if(isset($_GET['user_id'])&&isset($_GET['token'])&&isset($_GET['PayerID'])){
		
		include '../include/connection.php';
		$user_id=trim(mysqli_real_escape_string($con,$_GET['user_id']));
		$token=urldecode(trim(mysqli_real_escape_string($con,$_GET['token'])));
		$payer_id=urldecode(trim(mysqli_real_escape_string($con,$_GET['PayerID'])));
		
		
		require_once('PPBootStrap.php');
		$config = array (
			'mode' => 'sandbox' , 
			'acct1.UserName' => 'ziaurrehman1991-facilitator_api1.live.com',
			'acct1.Password' => '1390157164', 
			'acct1.Signature' => 'AUeUtwk0DhRSo6WixkKbIiLSug3sAKoqeMVb0O.cww-TR0tLRfuUjxsH'
		);

		$paypalService = new PayPalAPIInterfaceServiceService($config);
		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
		$getExpressCheckoutDetailsRequest->Version = '104.0';
		$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();

		$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

		try {
			//wrap API method calls on the service object with a try catch 
			$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
		} catch (Exception $ex) {
			echo 'Payment Unsucessfull';
			exit;
		}
	
		
		
		$details = $getECResponse->GetExpressCheckoutDetailsResponseDetails;


		//echo $details->PaymentDetails[0]->OrderTotal->currencyID;
		//echo $details->PaymentDetails[0]->OrderTotal->value;
		
		
		$paypalService = new PayPalAPIInterfaceServiceService($config);

		$paymentAction=urlencode('Sale');

		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
		$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
		$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

		$orderTotal = new BasicAmountType();
		$orderTotal->currencyID = $details->PaymentDetails[0]->OrderTotal->currencyID;
		$orderTotal->value = $details->PaymentDetails[0]->OrderTotal->value;

		$paymentDetails= new PaymentDetailsType();
		$paymentDetails->OrderTotal = $orderTotal;
		$paymentDetails->ItemTotal = $orderTotal;
		$paymentDetails->NotifyURL = '';
		$paymentDetails->PaymentDetailsItem=$details->PaymentDetails[0]->PaymentDetailsItem;
		$DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
		$DoECRequestDetails->PayerID = $payer_id;
		$DoECRequestDetails->Token = $token;
		$DoECRequestDetails->PaymentAction = $paymentAction;
		$DoECRequestDetails->PaymentDetails[0] = $paymentDetails;

		$DoECRequest = new DoExpressCheckoutPaymentRequestType();
		$DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;


		$DoECReq = new DoExpressCheckoutPaymentReq();
		$DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
		
		
		try {
			//wrap API method calls on the service object with a try catch 
			$DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
		} catch (Exception $ex) {
			echo 'Payment Unsucessfull';
			exit;
		}
		
		
		if(isset($DoECResponse)) {
			if(trim($DoECResponse->Ack)=='Success'){
				$paypal_transaction_id=$DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->TransactionID;
				$paypal_email_id=$details->PayerInfo->Payer;
				$gross_amount=$DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->GrossAmount->value;
				$fee_amount=$DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->FeeAmount->value;
				$paymant_status=$DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->PaymentStatus;
				$payment_date=$DoECResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo[0]->PaymentDate;
				
				$sql="insert into transactions (user_id,paypal_transaction_id,paypal_email_id,gross_amount,fee_amount,payment_status,payment_date,date_time) values($user_id,'$paypal_transaction_id','$paypal_email_id',$gross_amount,$fee_amount,'$paymant_status','$payment_date',now())";
				$result=mysqli_query($con,$sql);
				if($result){
					$transaction_id=mysqli_insert_id($con);
					foreach($details->PaymentDetails[0]->PaymentDetailsItem as $item){
						$type=substr(trim($item->Name),0,1);
						$item_id=trim($item->Number);
						$bounty=trim($item->Amount->value);
						if($type=='P'){
							$result=mysqli_query($con,"select user_id from projects where project_id=$item_id");
							$user_id_data=mysqli_fetch_array($result);
							$buy_from=$user_id_data['user_id'];
							mysqli_query($con,"insert into project_accounts (transaction_id,buy_from,bounty,project_id) values($transaction_id,$buy_from,$bounty,$item_id)");
							mysqli_query($con,"delete from project_carts where project_id=$item_id and user_id=$user_id");
							mysqli_query($con,"update profiles set earning=earning+$bounty where user_id=$buy_from");
							
						}
						else if($type=='A'){
							$result=mysqli_query($con,"select user_id from answers where answer_id=$item_id");
							$user_id_data=mysqli_fetch_array($result);
							$buy_from=$user_id_data['user_id'];
							mysqli_query($con,"insert into answer_accounts (transaction_id,buy_from,bounty,answer_id) values($transaction_id,$buy_from,$bounty,$item_id)");
							mysqli_query($con,"delete from answer_carts where answer_id=$item_id and user_id=$user_id");
							mysqli_query($con,"update profiles set earning=earning+$bounty where user_id=$buy_from");
							
						}
						else{
							echo 'Invalid Cart items';
						}
												
					}
          
					header("location: ../index.php");
				
				}
				else{
				
					echo 'Error in inserting data in database';
				}
			
			}
			else{
				echo $DoECResponse->Ack.'<br/>';
				foreach($DoECResponse->Errors as $error){
					echo $error->LongMessage.'<br/>';
				}
			}
				
		}	
		
		mysqli_close($con);
	}
	else{
		echo 'Invalid Request';
	}
	

	
?>				