<?php
require_once(dirname(__FILE__).'/src/iamport.php');

$path = 'https://hellotblog.files.wordpress.com/2018/07/11.pdf';
echo $path;

// $iamport = new Iamport('YOUR_IMP_REST_API_KEY', 'YOUR_IMP_REST_API_SECRET'); // hello@mkttalk.com
$iamport = new Iamport('6754834133706228', 'Tu1QH7BjTaKJy9TVuGZ9Wf25GTxI0RxTlyJ3Glmzv6j3gcZKTZUPeWVUQtDQkaJGJtJqO60jdjntvmep'); // leden_online@naver.com

#1. imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
$result = $iamport->findByImpUID('imp21028697'); //IamportResult 를 반환(success, data, error)

if ( $result->success ) {

  $path = 'https://hellotblog.files.wordpress.com/2018/07/11.pdf';
  // echo $path;
  header("Content-disposition: attachment; filename=PHP다운로드예시파일입니다.pdf");
  header("Content-type: application/pdf");
  readfile( $path );
  exit();


	/**
	*	IamportPayment 를 가리킵니다. __get을 통해 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
	*	참고 : https://api.iamport.kr/#!/payments/getPaymentByImpUid 의 Response Model
	*/
	$payment_data = $result->data;

	// echo '## 결제정보 출력 ##';
	// echo '가맹점 주문번호 : ' 	. $payment_data->merchant_uid;
	// echo '결제상태 : ' 		. $payment_data->status;
	// echo '결제금액 : ' 		. $payment_data->amount;
	// echo '결제수단 : ' 		. $payment_data->pay_method;
	// echo '결제된 카드사명 : ' 	. $payment_data->card_name;
	// echo '결제 매출전표 링크 : '	. $payment_data->receipt_url;
  //
	// /**
	// *	IMP.request_pay({
	// *		custom_data : {my_key : value}
	// *	});
	// *	와 같이 custom_data를 결제 건에 대해서 지정하였을 때 정보를 추출할 수 있습니다.(서버에는 json encoded형태로 저장합니다)
	// */
	// echo 'Custom Data :'	. $payment_data->getCustomData('my_key');

	# 내부적으로 결제완료 처리하시기 위해서는 (1) 결제완료 여부 (2) 금액이 일치하는지 확인을 해주셔야 합니다.
	// $amount_should_be_paid = 10;
	// if ( $payment_data->status === 'paid' && $payment_data->amount === $amount_should_be_paid ) {
	// 	// ... : 결제성공 처리
	// }

} else {
	// error_log($result->error['code']);
	// error_log($result->error['message']);
}
