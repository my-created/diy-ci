<html>
<head>
    <link rel="stylesheet" type="text/css" href="">
</head>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layer/layer.js"></script>
<body>
<div class="main">
    bouutn
    <input name="agent"style="width: 140px height:30px; line-height:30px;" placeholder="请输入搜索内容" type="text" class="agent_name"/>
    <button class="seek search_submit" ></button>
    <div class="main_header">
        <div class="icon">
            <table class="main_icon">
                <tr class="th">
                    <th>项目编号</th>
                    <th>报备日期</th>
                    <th>客户名称</th>
                    <th>省市</th>
                    <th>市区</th>
                    <th>行业</th>
                    <th>项目规模</th>
                    <th>客户联系人</th>
                    <th>客户联系电话</th>
                    <th>竞争品牌</th>
                    <th>预计采购方式</th>
                    <th>报备联系人</th>
                    <th>报备联系方式</th>
                </tr>

            </table>
            <div class="box">
                <div class="page">
                    <p>总计：<span id="c_num"></span>
                        <a href="<?=base_url(array('essmgr', 'export2csv', '0'))?>" class="export2csv">导出数据</a>
                    </p>
                    <ul class="page_style">
                        <li class="page_num type_one">1</li>
                    </ul>
                    <input type="hidden" id="now_page" value="1"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        getListData();
    })
    function getListData() {
            layer.load(2);
            $.ajax({
                type: "post",
                url: "<?php echo base_url(array('project', 'getData'));?>",
                data: {

                    "agent_name":$('.agent_name').val(),
                    'page':$('#now_page').val()
                },
                complete: function () {
                    setTimeout(function () {
                        layer.closeAll('loading');
                    }, 400);
                },
                success: function (data) {
                    var datas = JSON.parse(data);
                    console.log(datas);
                    //清空表格内容
                    $('.main_icon tr:gt(0)').remove();
                    //获得了数据,开始填充
                    $('#c_num').text(datas['count'][0]['num']);
                    if(datas['data'].length !== 0) {
                        for (var i = 0; i < datas['data'].length; i++) {
                            $('.main_icon').append(
                                $('<tr class="matter" >' +
                                ' <td title="' + datas['data'][i]["name"]+ '">' + datas['data'][i]["name"] + '</td>' +
                                '<td title="' + (datas['data'][i]["quantity"]) + '">' + (datas['data'][i]["quantity"]) + '台</td>' +
                                ' <td title="' + datas['data'][i]["num"]+ '">' + datas['data'][i]["num"]+ '个</td>' +
                                '<td title="' + (datas['data'][i]["time"]) + '">' + (datas['data'][i]["time"]) + '月</td>' +
                                ' <td title="' + datas['data'][i]["create_time"]+ '">' + datas['data'][i]["create_time"] + '</td>' +
                                ' <td><form action="<?php echo base_url(array('agent', 'get_download'));?>" method="post"><input type="hidden"  name="id" value="' + datas['data'][i]["id"]+ '"><input type="submit" style="cursor: pointer; text-indent:0px;border: 1px solid #FFF;"  value="下载"></form></td>' +
                                '</tr>'));
                        }
                        var page_size = <?php echo PAGE_NUM;?>;
                        page_select($('#now_page').val(),datas['count'][0]['num'],page_size);
                    }
                }
            })
    }
</script>
</body>
</html>