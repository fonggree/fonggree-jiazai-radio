<?php
/**
 * Created by PhpStorm.
 * User: jack01
 * Date: 2017/6/14
 * Time: 下午3:15
 */

namespace Costa92\Wechat\Applet;


/**
 * 对微信小程序用户加密数据的解密示例代码.
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */




class WXBizDataCrypt
{
    private $appid;
	private $sessionKey;

	/**
	 * 构造函数
	 * @param $sessionKey string 用户在小程序登录后获取的会话密钥
	 * @param $appid string 小程序的appid
	 */
	public function __construct( $appid, $sessionKey)
	{
		$this->sessionKey = $sessionKey;
		$this->appid = $appid;
	}


	/**
	 * 检验数据的真实性，并且获取解密后的明文.
	 * @param $encryptedData string 加密的用户数据
	 * @param $iv string 与用户数据一同返回的初始向量
	 * @param $data string 解密后的原文
     *
	 * @return int 成功0，失败返回对应的错误码
	 */
	public function decryptData( $encryptedData, $iv, &$data )
	{
		if (strlen($this->sessionKey) != 24) {
			return array('code'=>ErrorCode::$IllegalAesKey);
		}
		$aesKey=base64_decode($this->sessionKey);

        
		if (strlen($iv) != 24) {
			return array('code'=>ErrorCode::$IllegalIv);
		}
		$aesIV=base64_decode($iv);

		$aesCipher=base64_decode($encryptedData);

		$pc = new Prpcrypt($aesKey);
		$result = $pc->decrypt($aesCipher,$aesIV);
        
		if ($result[0] != 0) {
			return array('code'=>$result[0]);
		}
     
        $dataObj=json_decode( $result[1] );
        if( $dataObj  == NULL )
        {
            return array('code'=>ErrorCode::$IllegalBuffer);
        }
        if( $dataObj->watermark->appid != $this->appid )
        {
            return array('code'=>ErrorCode::$IllegalBuffer);
        }
        
		return array('code'=>ErrorCode::$OK,'data'=>$dataObj);
	}

}