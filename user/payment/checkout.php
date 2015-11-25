<?php 
	include_once '../include/lock_normal.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		
		<style>
		
		
		</style>
		<script>
		
		</script>
	</head>
	<body>
		<?php
			use PayPal\CoreComponentTypes\BasicAmountType;
			use PayPal\EBLBaseComponents\AddressType;
			use PayPal\EBLBaseComponents\BillingAgreementDetailsType;
			use PayPal\EBLBaseComponents\PaymentDetailsItemType;
			use PayPal\EBLBaseComponents\PaymentDetailsType;
			use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
			use PayPal\PayPalAPI\SetExpressCheckoutReq;
			use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
			use PayPal\Service\PayPalAPIInterfaceServiceService;
			require_once('PPBootStrap.php');

			$config = array (
				'mode' => 'sandbox' , 
				'acct1.UserName' => 'ziaurrehman1991-facilitator_api1.live.com',
				'acct1.Password' => '1390157164', 
				'acct1.Signature' => 'AUeUtwk0DhRSo6WixkKbIiLSug3sAKoqeMVb0O.cww-TR0tLRfuUjxsH'
			);
			$paypalService = new PayPalAPIInterfaceServiceService($config);
			$paymentDetails= new PaymentDetailsType();
			include '../include/connection.php';
			$sum=0;
			$count=0;
			$result=mysqli_query($con,"select * from answer_carts where user_id=$login_session");
			while($row=mysqli_fetch_array($result)){
				$itemDetails = new PaymentDetailsItemType();
				$answer_id=$row['answer_id'];
				$answer=mysqli_query($con,"select * from answers where answer_id=$answer_id");
				$answer_details=mysqli_fetch_array($answer);
				$abstract=$answer_details['abstract'];
				$bounty=$answer_details['bounty'];
				$itemDetails->Name = 'Answer id: '.$answer_id;
				$itemDetails->Number = $answer_id;
				$description=substr($abstract,0,50).'...';
				$itemDetails->Description=$description;
				$itemDetails->ItemCategory='Digital';
				$itemDetails->Amount = $bounty;
				$itemDetails->Quantity = '1';
				$paymentDetails->PaymentDetailsItem[$count] = $itemDetails;
				$count++;
				$sum=$sum+$bounty;
			}
			$result=mysqli_query($con,"select * from project_carts where user_id=$login_session");
			while($row=mysqli_fetch_array($result)){
				$itemDetails = new PaymentDetailsItemType();
				$project_id=$row['project_id'];
				$project=mysqli_query($con,"select * from projects where project_id=$project_id");
				$project_details=mysqli_fetch_array($project);
				$title=$project_details['title'];
				$bounty=$project_details['bounty'];
				$itemDetails->Name = 'Project id: '.$project_id;
				$itemDetails->Number = $project_id;
				$description=substr($title,0,50).'...';
				$itemDetails->Description=$description;
				$itemDetails->ItemCategory='Digital';
				$itemDetails->Amount = $bounty;
				$itemDetails->Quantity = '1';
				$paymentDetails->PaymentDetailsItem[$count] = $itemDetails;
				$count++;
				$sum=$sum+$bounty;
			}
			mysqli_close($con);
			if($count==0){
				header('location: ../index.php');
			}
			
			
			$orderTotal = new BasicAmountType();
			$orderTotal->currencyID = 'USD';
			$orderTotal->value = $sum; 
			
			$paymentDetails->OrderTotal = $orderTotal;
			$paymentDetails->ItemTotal = $orderTotal;
			$paymentDetails->PaymentAction = 'Sale';

			$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
			
			$setECReqDetails->PaymentDetails[0] = $paymentDetails;
			$setECReqDetails->CancelURL = 'http://memoryleak14.byethost14.com/user/payment/cancel.php';
			$setECReqDetails->ReturnURL = 'http://memoryleak14.byethost14.com/user/payment/paymentreturn.php?user_id='.$login_session;
			$setECReqDetails->NoShipping='1';
			$setECReqDetails->ReqConfirmShipping='1';
			
			$setECReqType = new SetExpressCheckoutRequestType();
			$setECReqType->Version = '104.0';
			$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;

			$setECReq = new SetExpressCheckoutReq();
			$setECReq->SetExpressCheckoutRequest = $setECReqType;

			$setECResponse = $paypalService->SetExpressCheckout($setECReq);
			if($setECResponse->Ack =='Success') {
				$token = $setECResponse->Token;
				// Redirect to paypal.com here
				$payPalURL = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $token;
				header('location: '.$payPalURL.'');
			}
		?>
	</body>
</html>