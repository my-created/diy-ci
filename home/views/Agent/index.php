<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
The Index Template  ajax
</body>
<script src="/static/js/jquery.min.js"></script>
<script>
$(function () {
    $.ajax({
    url:"<?=base_url('Agent/list')?>",    //请求的url地址
    dataType:"html",   //返回格式为json
    async:true,//请求是否异步，默认为异步，这也是ajax重要特性
    data:{"<?=$csrf['name']?>":"<?=$csrf['hash']?>"},    //参数值
    type:"POST",   //请求方式
    beforeSend:function(){
        //请求前的处理
    },
    success:function(req){
        console.log(req);
    },
    complete:function(){
        //请求完成的处理
    },
    error:function(){
        //请求出错处理
    }
});
});

</script>
</html>