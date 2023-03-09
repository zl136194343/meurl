<?php declare(strict_types=1);

namespace WeChatPay\Util;

use function openssl_x509_read;
use function openssl_x509_parse;
use function file_get_contents;
use function strtoupper;
use function strpos;

use UnexpectedValueException;

use WeChatPay\Crypto\Rsa;

/**
 * Util for read private key and certificate.
 */
class PemUtil
{
    private const LOCAL_FILE_PROTOCOL = 'file://';

    /**
     * Read private key from file
     * @deprecated v1.2.0 - Use `Rsa::from` instead
     *
     * @param string $filepath - PEM encoded private key file path
     *
     * @return \OpenSSLAsymmetricKey|resource|mixed
     */
    public static function loadPrivateKey(string $filepath)
    {
        return Rsa::from((false === strpos($filepath, self::LOCAL_FILE_PROTOCOL) ? self::LOCAL_FILE_PROTOCOL : '') . $filepath);
    }

    /**
     * Read private key from string
     * @deprecated v1.2.0 - Use `Rsa::from` instead
     *
     * @param \OpenSSLAsymmetricKey|resource|string|mixed $content - PEM encoded private key string content
     *
     * @return \OpenSSLAsymmetricKey|resource|mixed
     */
    public static function loadPrivateKeyFromString($content)
    {
        return Rsa::from($content);
    }

    /**
     * Read certificate from file
     *
     * @param string $filepath - PEM encoded X.509 certificate file path
     *
     * @return \OpenSSLCertificate|object|resource|bool - X.509 certificate resource identifier on success or FALSE on failure
     * @throws UnexpectedValueException
     */
    public static function loadCertificate(string $filepath)
    {
        $content = file_get_contents($filepath);
        if (false === $content) {
            throw new UnexpectedValueException("Loading the certificate failed, please checking your {$filepath} input.");
        }

        return openssl_x509_read($content);
    }

    /**
     * Read certificate from string
     *
     * @param \OpenSSLCertificate|object|resource|string|mixed $content - PEM encoded X.509 certificate string content
     *
     * @return \OpenSSLCertificate|object|resource|bool - X.509 certificate resource identifier on success or FALSE on failure
     */
    public static function loadCertificateFromString($content)
    {
        return openssl_x509_read($content);
    }

    /**
     * Parse Serial Number from Certificate
     *
     * @param \OpenSSLCertificate|object|resource|string|mixed $certificate Certificates string or resource
     *
     * @return string - The serial number
     * @throws UnexpectedValueException
     */
    public static function parseCertificateSerialNo($certificate): string
    {
        $info = openssl_x509_parse($certificate);
        if (false === $info || !isset($info['serialNumberHex'])) {
            throw new UnexpectedValueException('Read the $certificate failed, please check it whether or nor correct');
        }

        return strtoupper($info['serialNumberHex']);
    }
}
{"global":{"title":"首页","bgColor":"#f7f7f7","topNavColor":"#ffd500","topNavbg":true,"textNavColor":"#303133","topNavImg":"upload/common/images/20220630/20220630013120165656708049211.png","moreLink":{"name":"INDEX","parent":"MALL_PAGE","childer":"MALL_LINK","title":"主页","wap_url":"/pages/index/index/index","menuOne":"MALL_PAGE","type":1,"menuTwo":"MALL_LINK"},"openBottomNav":true,"navStyle":3,"textImgStyleLink":"1","textImgPosLink":"left","mpCollect":false,"popWindow":{"imageUrl":"upload/common/images/20220810/20220810093648166009540857212.jpg","count":1,"link":{"name":"","parent":"MALL_PAGE","childer":"MALL_LINK","title":"小谷粒家长端","wap_url":"/glpages/message_detail/message_detail?con_id=33","menuOne":"CUSTOM_LINK","type":3,"menuTwo":"ALL_GOODS"},"imgWidth":"600","imgHeight":"860"},"bgUrl":"upload/common/images/20220509/20220509021408165207684856547.png","imgWidth":"52","imgHeight":"34"},"value":[{"selectedTemplate":"carousel-posters","imageClearance":0,"imageRadius":"fillet","carouselChangeStyle":"line","marginTop":0,"padding":0,"height":0,"list":[{"imageUrl":"upload/common/images/20220928/20220928110117166433407749123.png","title":"","link":{"menuOne":"CUSTOM_LINK","menuTwo":"GOODS_CATEGORY","type":3,"name":"","wap_url":"/glpages/message_detail/message_detail?con_id=54","title":"国庆"},"imgWidth":"750","imgHeight":"348"},{"imageUrl":"upload/common/images/20220907/20220907110631166251999143321.png","title":"","link":{"menuOne":"CUSTOM_LINK","menuTwo":"MALL_LINK","type":3,"name":"","title":"鲁湖农场","wap_url":"/glpages/message_detail/message_detail?con_id=52"},"imgWidth":"750","imgHeight":"348"},{"imageUrl":"upload/common/images/20220914/20220914050847166314652725031.png","title":"","link":{"menuOne":"CUSTOM_LINK","menuTwo":"MALL_LINK","type":3,"name":"","title":"易游天下","wap_url":"/glpages/message_detail/message_detail?con_id=53"},"imgWidth":"750","imgHeight":"348"},{"imageUrl":"upload/common/images/20220705/20220705114955165699299522132.png","title":"","link":{"menuOne":"CUSTOM_LINK","menuTwo":"MALL_LINK","type":3,"name":"","title":"小程序上线","wap_url":"/glpages/message_detail/message_detail?con_id=33"},"imgWidth":"1173","imgHeight":"544"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"textColor":"#666666","defaultTextColor":"#666666","navRadius":"fillet","backgroundColor":"","selectedTemplate":"imageNavigation","showType":"3","scrollSetting":"fixed","padding":20,"marginTop":0,"list":[{"imageUrl":"upload/common/images/20220818/20220818031507166080690776542.png","title":"亲子游玩","link":{"name":1,"menuOne":"MALL_PAGE","menuTwo":"GOODS_CATEGORY","type":4,"wap_url":"/glpages/goods/list/list?category_id=1","title":"亲子游玩"},"imgWidth":"80","imgHeight":"80"},{"imageUrl":"upload/common/images/20220705/20220705112912165699175219053.png","title":"赛事活动","link":{"name":2,"menuOne":"MALL_PAGE","menuTwo":"GOODS_CATEGORY","type":4,"title":"赛事活动","wap_url":"/glpages/goods/list/list?category_id=2"},"imgWidth":"120","imgHeight":"120"},{"imageUrl":"upload/common/images/20220509/20220509021520165207692012183.png","title":"农家美食","link":{"menuOne":"MALL_PAGE","menuTwo":"GOODS_CATEGORY","type":4,"name":27,"title":"农家美食2","wap_url":"/glpages/goods/list/list?category_id=27"},"imgWidth":"80","imgHeight":"80"}],"addon_name":"","type":"GRAPHIC_NAV","name":"图文导航","controller":"GraphicNav","is_delete":"0"},{"sources":"default","backgroundColor":"#ffffff","marginTop":5,"style":1,"isEdit":1,"styleName":"风格一","textColor":"#333333","defaultTextColor":"#333333","fontSize":14,"list":[{"title":"小谷粒家长端华丽蜕变","link":{"name":"","menuOne":"CUSTOM_LINK","menuTwo":"MALL_LINK","type":3,"title":"小谷粒家长端-微信小程序上线","wap_url":"/glpages/message_detail/message_detail?con_id=33"}},{"title":"鲁湖生态农场","link":{"menuOne":"CUSTOM_LINK","menuTwo":"MALL_LINK","type":3,"name":"","title":"鲁湖","wap_url":"/glpages/message_detail/message_detail?con_id=52"}}],"noticeIds":[],"addon_name":"","type":"NOTICE","name":"公告","controller":"Notice","is_delete":"0"},{"height":10,"backgroundColor":"","marginLeftRight":0,"addon_name":"","type":"HORZ_BLANK","name":"辅助空白","controller":"HorzBlank","is_delete":"0"},{"selectedTemplate":"row1-tp-of2-bm","backgroundColor":"","list":[{"imageUrl":"upload/common/images/20220908/20220908094546166260154678374.png","link":{"name":"PINTUAN_PREFECTURE","menuOne":"MALL_PAGE","menuTwo":"MARKETING_LINK","type":1,"wap_url":"/promotionpages/pintuan/list/list","title":"拼团专区","parent":"MALL_PAGE","childer":"MALL_LINK"},"imgWidth":"1000","imgHeight":"464"},{"imageUrl":"upload/common/images/20220818/20220818104757166079087764132.png","link":{"name":{"ALL_GOODS":931},"menuOne":"COMMODITY","menuTwo":"ALL_GOODS","type":2,"wap_url":"/glpages/goods/detail/detail?sku_id=931","title":"2022DS自然探索赛-武汉站【4-7岁亲子组报名啦！】","parent":"MALL_PAGE","childer":"MALL_LINK"},"imgWidth":"400","imgHeight":"240"},{"imageUrl":"upload/common/images/20220818/20220818104757166079087760999.png","link":{"menuOne":"COMMODITY","menuTwo":"ALL_GOODS","type":2,"name":{"ALL_GOODS":895},"title":"2022DS自然探索赛-武汉站【6-14岁个人组报名啦！】","wap_url":"/glpages/goods/detail/detail?sku_id=895"},"imgWidth":"400","imgHeight":"240"}],"selectedRubikCubeArray":[],"diyHtml":"","customRubikCube":4,"heightArray":["74.25px","59px","48.83px","41.56px"],"imageGap":15,"addon_name":"","type":"RUBIK_CUBE","name":"魔方","controller":"RubikCube","is_delete":"0"},{"selectedTemplate":"single-graph","imageClearance":0,"imageRadius":"right-angle","carouselChangeStyle":"circle","marginTop":20,"padding":0,"height":0,"list":[{"imageUrl":"upload/common/images/20220509/20220509021619165207697989250.png","title":"","link":{"name":""},"imgWidth":"750","imgHeight":"56"}],"addon_name":"","type":"IMAGE_ADS","name":"图片广告","controller":"ImageAds","is_delete":"0"},{"sources":"diy","categoryId":"3","categoryName":"园所拓展","goodsCount":0,"goodsId":["61","38","29"],"style":"2","backgroundColor":"","marginTop":10,"paddingLeftRight":0,"isShowCart":0,"cartStyle":1,"isShowGoodName":1,"isShowMarketPrice":1,"isShowGoodSaleNum":1,"isShowGoodSubTitle":0,"goodsTag":"notshow","tagImg":{"imageUrl":""},"addon_name":"","type":"GOODS_LIST","name":"商品列表","controller":"GoodsList","is_delete":"0"}]}