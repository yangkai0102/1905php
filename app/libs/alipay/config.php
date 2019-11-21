<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101400681523",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAz6Hw9XIE4qGv2OoMvWvac28GK4Wjelth9ZTb6TRdr7ZaGES/An9gcl9Xihc/4O7e1TZJkTudwQzz0so0nXGuIn8zmBWj7KxCRQjY5eLloRoVPTCR5RiHjCaTnut9Jsq1AqSKPO88niD96GkW7/TDCbK6/OKmAa3IFoZoCNsIACzA9WV4y2RcoUOnHFx6drhonc0tt1J+qnbins1Ejpe/DeusP6I9LHvBT7/Y4UniuMPBiwPF2oZ32ew0I178b8DIhawtAvQba+yYV97rD5jQWYqHuUN/6K6+PV5LSevJV5KNDEI/1/hzTZ+YPMZjbRnRiVRUztiA2Nti03SwensfwQIDAQABAoIBAEidUjAE2ECKW315HUuB1LxaL8Y4zpuUKgZBMUe10K4LECc8o7Cz638UaQEacHSyFaxrd/8a4mkJppwpq40EnOnjop+lsdarx+Fs3q5HVBerj5H+0odUtNMHCsmhgft3GSb7dH0rDgAfea02U5dH+o4Bu/OFMJmVtUxrZSbzszCb1I6UwQeMz7zvvI53/M5Zn3mw8L9ugavD9Un3l+NdyyXJaaEB3xQVILJrUZUc0sB6pEm1c6W+tjTuusgC40c2yyyImkNcKlunkgwrkunGJOkUTKBdOJjVJhgmNYT4Fk2GkS90bgJ1fryCE0mchkntBGbmWgI4BA+Tzku2yaVooAECgYEA+AhARpKAqq2GXL9Nj4BgmtWatYd9pLLx4368Aj1IgUZVs9kvAGw/rgszKEaLTwJ1cXNPSsMxMXsyrMsixaglR7hUcs9QVs0T2PtYIU05JF/Wa1nUG5G7NPnyZzfYYVgsLp5InmS4lEzO2niUSryPHf6AftN4XZAPFhCeAVdxF6ECgYEA1k10XlCuiYthJkjQPnAPoT8ff8cd13CIHLmGBj0NUIEIzA2uqC13zMW2BCVZyXG1//uJ+kvB+ZLxHDkTnENAKAlB2VeT43Mhge7qVso5nx33xxOkXkkJh4GnP4is+D37mtrss96dO6QlXK+8VCCk/Xvf43fSzG/CDECul/J+lCECgYEA2g7e+2x3ZBZ0hvvE44F47QcYIboBsxeDY38bKVjZcpX0aM5q7RM+FPRRwHnspcTCncBDmLXsfNUT4ygf5OgEBn6+98Tdm8JmTaADhhuPPjRnnS93M9m2XUfVXfuR51sOVNnhfCeOwwqX3SifLumBZVxHebjPHGq3aK2pTAKlMaECgYEAv5U87Dha4NH/BvffW4JZJsFEyrnavsh2lp9w5tDbv1Wr5KhytRz41dMG9svhagrDN1bLsjzZ6+FmteF825zvlRs5iDEYICXEFeHeE7r0KoDjC1FPB49p+n95Yn4wjDj1XypKpD7m9/O2BxeAWQFaHtcIf9WWWXer1cJZk7ORX6ECgYBJldx4mqtyaUpqGzhDXCVjFBYhSMb7wqdZkbRW30njOT/X8B2aB9tKByYwZq6QWKRAansggREl7M5LAVlUJAFBLL24S0roCP9s3VqVyu7KZeJaOLTYFvmR5eOXnyv42eyO5W4l4H5uBMGLUw5vIUg+t9sN1L9HL3oW7avm6c+OOg==",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://yk.cn/",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApp4L3gNiE0XMjbGw7A2yH2csg2EqCZPn53fVgHlFIBXPYAumEUdlGa9ezO3VbJwRlTzakm8y/bj7RWzQ1ONajQVAMfnnNSpQQYtbQlHoUvv+rVa9WuXrwPudHX5YKyPRcqtYV28768UGpJQixTLQVbPxqb2hoO2lB3L9EKU95I/MLYyNIHG0uP/lFj54jWQHqBh8S6fti22n984F/kMgsgRM957kQNbMTVjIdxpjVoB3nJX40RFjQhsmYsrcxQbOg1uRXyfb5Kzax+DPS2YKqFkLkHslQExmxbA7iMn0ell1qrhx7jr0iPq968UzcHd8Bjlu2Nea8MbZKOPBEv/73wIDAQAB",
		
	
);