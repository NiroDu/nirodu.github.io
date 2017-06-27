//share 

$('.input_share').on('tap', function() {
    $('.mc').css('display', "block")
})
$('.mc').on('tap', function() {
    $('.mc').css('display', "none")
})
$('.input_index').on('tap', function() {
    $('.page1').css('display', 'block');
    $('.page2_labe').css('display', 'none');
})



function getUrl(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return "Please input keywords here";
}
var id = getUrl("id");
if (id == "1") {
    $('.page1').css('display', 'none');
    $('.page2_labe').css('display', 'block');
}

var ysj = [
    "开单王",
    "爬楼高手",
    "师奶杀手",
    "秒成交",
    "神业绩",
    "销冠",
    "电动车神车手",
    "话术终结者",
    "置业专家",
    "业主红人",
    "房东好基友",
    "只做诚信二手房",
    "一不开单就容易伤心",
    '没客户浑身难受',
    "端口营销达人",
    "数钱数到手抽筋",
    "房源标题党",
    "方圆百里街霸王",
    "心算大神",
    "房价神预测",
    "百万经纪人",
    '房产精英',
    "未来百万门店店长",
    "五星级专业服务",
    "颜值最高的房产经纪人",
    "房产界的高富帅",
    "单身经纪人中好像也有你",
    "销售强者",
    "开启无敌鸡血模式",
    "客户最放心的人选",
    '偶尔喜欢逗比',
    "像一匹狼",
    "女神都喜欢的那个范",
    "房产经纪霸主",
    "店长的心肝宝贝",
    "靠脸成交，可耻！",
    "擅长细水长流",
    "风水学大师",
    "行业名人",
    "房产人生赢家",
    "超强促单高手",
    "最佳带看男主角",
    "互联网房产中介头目"
]

// 定义存放生成随机数的数组 
var array = new Array();
// 循环N次生成随机数 
for (var i = 0;; i++) {
    // 只生成10个随机数 
    if (array.length < 10) {
        generateRandom(44);
    } else {
        break;
    }
}
// 循环遍历随机数数组 
for (var i = 0; i < array.length; i++) {
    $('.label' + i).html(ysj[array[i]])
    console.log(ysj[array[i]])
}
// 生成随机数的方法 
function generateRandom(count) {
    var rand = parseInt(Math.random() * count);
    for (var i = 1; i < array.length; i++) {
        if (array[i] == rand) {
            return false;
        }
    }
    array.push(rand);
}
console.log(array)
