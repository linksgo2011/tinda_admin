<?php
ini_set('date.timezone','Asia/Shanghai');
require_once("../../include/global.php");

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}

		// 充值操作
        $orderNumber = $data['out_trade_no'];

		$querySql = "select * from order where order_number='$orderNumber'";

		$rs = mysql_query($querySql);
		$order = mysql_fetch_assoc($rs);

        Log::DEBUG("order:" . json_encode($order));

        if(!$order['is_dealed']){
            // 充值逻辑

            $userId = $order['user_id'];

            $querySql = "select * from `feedbackinfo` where id=$userId";
            $rs = mysql_query($querySql);
            $user = mysql_fetch_assoc($rs);

            $endDateTimeStamp = strtotime($user['end_date']) + $order['days']*24*60*60;
            $endDate = date("Y-m-d",$endDateTimeStamp);

            mysql_query("update `feedbackinfo` set end_date='$endDate' where id=$userId");

            mysql_query("update `order` set is_dealed=1 where order_number='$orderNumber'");
        }

		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
