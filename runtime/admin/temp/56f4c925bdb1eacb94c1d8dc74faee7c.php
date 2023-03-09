<?php /*a:1:{s:62:"/www/wwwroot/ls.chnssl.com/app/admin/view/commonutil/link.html";i:1614518646;}*/ ?>
<style>
    .link-box{font-size:12px}
    .link-box .link-center{display:flex;height:480px}
    .link-box .link-left{overflow-y:auto;width:138px;height:100%;border-right:1px solid #f2f2f2}
    .link-box .link-left dt{position:relative;padding-left:15px;height:32px;line-height:32px;color:#333;cursor:pointer;transition:all .3s}
    .link-box .link-left dt.triangle:after{content:'';position:absolute;left:0;top:51%;transform:translateY(-50%);border:4px solid transparent;border-right-color:#333;border-bottom-color:#333;cursor:pointer}
    .link-box .link-left dt.active:after{transform:translateY(-50%) rotate(-45deg)}
    .link-box .link-left dd{margin-right:25px;padding-left:25px;height:32px;line-height:32px;color:#666;cursor:pointer}
    .link-box .link-left dd:hover{background-color:#f2f2f2}
    .link-box .link-right{overflow-y:auto;height:100%;flex:1;padding-left:20px}
    .link-box .link-right dl{overflow:hidden}
    .link-box .link-right dt{height:40px;line-height:40px}
    .link-box .link-right dd{float:left;margin:5px 5px 5px 0;padding:0 16px;border:1px solid #ededed;border-radius:3px;line-height:30px;color:#666;cursor:pointer}
    .link-box .link-right .layui-table-body{height:285px}
    .link-btn{margin-top:20px;padding-right:10px;height:45px;line-height:45px;text-align:right;border-top:1px solid #f2f2f2}
    .link-box .custom-link{width:360px;margin:50px}
    .link-box .ns-word-aux{width:250px}
    .layui-layer-content .layui-form{padding:0 !important}
    .goods-category-list .layui-table td{border-left: 0;border-right: 0;}
    .goods-category-list .layui-table .switch{font-size: 16px;cursor: pointer;width: 12px;line-height: 1;display: inline-block;text-align: center;vertical-align: middle;}
    .goods-category-list .layui-table img{width: 40px;}
</style>

<div class="link-box">
    <div class="link-center">
        <div class="link-left">
            <?php foreach($list as $key => $item): ?>
            <dl>
                <dt data-ident="<?php echo htmlentities($item['name']); ?>" class="<?php if(!empty($item['child_list'])): ?>triangle active<?php endif; ?>"><?php echo htmlentities($item['title']); ?></dt>
                <?php foreach($item['child_list'] as $child_key =>$child_item): ?>
                    <dd data-ident="<?php echo htmlentities($child_item['name']); ?>" class="layui-hide"><?php echo htmlentities($child_item['title']); ?></dd>
                <?php endforeach; ?>
            </dl>
            <?php endforeach; ?>
        </div>
        <div class="link-right"></div>
    </div>
    <div class="link-btn">
        <button class="layui-btn link-eliminate layui-btn-primary">清空</button>
        <button class="layui-btn link-save ns-bg-color">确定</button>
    </div>
</div>
<script>
    /**
     * link 的数据结构
     * {
     *     type:1, 1表示类型为模块、3表示类型为表格、3表示类型为自定义
     *     menuOne:'', 表示左侧一级菜单选中标识
     *     menuTwo:'', 标识左侧二级菜单选中标识
     *     name:'', 表示内容选择标识，
     *     title:'',
     *     wap_url:''
     * }
     * */
    var link= {
        currentLink:'<?php echo html_entity_decode(json_encode($link)); ?>',
        temporayLink:{menuOne:'MALL_PAGE',menuTwo:'MALL_LINK',type:1,name:'MALL_LINK'}
    };
    if (Object.keys(JSON.parse(link.currentLink)).length > 1){
        link.currentLink = JSON.parse(link.currentLink);
        link.temporayLink = Object.assign({}, link.currentLink);
    }else{
        link.currentLink = {menuOne:'MALL_PAGE',menuTwo:'MALL_LINK',type:1,name:'MALL_LINK'};
    }
    var tableData = JSON.parse('<?php echo json_encode($dict); ?>');
    var post = '<?php echo htmlentities($post); ?>'; //显示端口 admin、shop
    var support_diy_view = '<?php echo htmlentities($support_diy_view); ?>'; //限制条件，限制只能在admin或shop出现

    initMenu(link.temporayLink);
    initData(link.temporayLink);

    //初始化菜单
    function initMenu(obj){
        var menuOne = obj.menuOne,
            menuTwo = obj.menuTwo;

        //左侧一级菜单
        $(".link-box .link-left dt").each(function (index,item) {
            var itemIdent = $(item).attr('data-ident');
            //特殊处理自定义
            if (menuOne == "CUSTOM_LINK" && itemIdent == "CUSTOM_LINK"){
                $(item).addClass("ns-text-color 1111").removeClass('active');
                $(".link-left dt").addClass('active');
                $(".link-left dd").addClass('layui-hide').removeClass('ns-text-color');
                return false;
            }

            if(menuOne == itemIdent) {
                $(".link-left dd").addClass('layui-hide');
                $(".link-left dt").addClass('active');
                $(item).parents("dl").find("dd").removeClass('layui-hide');
                $(item).removeClass('active');
            }
        });


        //左侧二级菜单
        if (menuOne == "CUSTOM_LINK") return false;
        $(".link-box .link-left dd").each(function (index,item) {
            var itemIdent = $(item).attr('data-ident');
            if(menuTwo == itemIdent){
                $(".link-left dd").removeClass('ns-text-color');
                $(".link-left dt").removeClass('ns-text-color');
                $(item).addClass('ns-text-color');
                return false;
            }
        });
    }

    //初始化数据
    function initData(obj){
        if (obj.type == 1){
            $.ajax({
                url : "<?php echo addon_url('admin/commonutil/childLink'); ?>",
                data: {name: obj.menuTwo,post,support_diy_view},
                dataType: 'json',
                type: 'post',
                success : function(data) {
                    var list = data.list,
                        html = '';
                    for (var i = 0; i < list.length; i++){
                        html += `<dl>`;
                        html += `<dt>${list[i].title}</dt>`;
                        if (list[i].child_list != undefined) {
                            for (var j = 0; j < list[i].child_list.length; j++){
                                if (list[i].child_list[j].name == obj.name)
                                    html += `<dd data-value='${JSON.stringify(list[i].child_list[j])}' class="ns-border-color">${list[i].child_list[j].title}</dd>`;
                                else
                                    html += `<dd data-value='${JSON.stringify(list[i].child_list[j])}'>${list[i].child_list[j].title}</dd>`;
                            }
                        }
                        html += `</dl>`
                    }
                    $(".link-right").html(html);
                }
            });
        }
        else if (obj.type == 2){
            var html = '';
            html += `<div class="ns-single-filter-box">`;
                html += `<div class="layui-form">`;
                    html += ` <div class="layui-input-inline">`;
                        html += `<input type="text" name="goods_name" placeholder="请输入商品名称" autocomplete="off" class="layui-input">`;
                        html += `<button type="button" class="layui-btn layui-btn-primary" lay-filter="search" lay-submit>`;
                        html += `<i class="layui-icon">&#xe615;</i>`;
                    html += `</div>`;
                html += `</div>`;
            html += `</div>`;

            html += `<table id="goods_list" lay-filter="goods_list"></table>`;
            $(".link-right").html(html);

            var  goodsCols = [
                [{
                    unresize: 'false',
                    width: '8%',
                    templet: '#checkbox'
                },{
                    title: '商品',
                    unresize: 'false',
                    width: '62%',
                    templet: '#goods_info'
                },{
                    field: tableData[obj.menuTwo].goodsColsParameter ? tableData[obj.menuTwo].goodsColsParameter.price : 'price',
                    title: '价格',
                    unresize: 'false',
                    width: '15%'
                },
                    {
                        field: 'goods_stock',
                        title: '库存',
                        unresize: 'false',
                        width: '15%'
                    }]
            ];
            var where = {promotion :tableData[obj.menuTwo].promotion,post:post};
            var table = new Table({
                elem: '#goods_list',
                url: tableData[obj.menuTwo].url || '<?php echo addon_url("admin/commonutil/goodslist"); ?>',
                where: where,
                cols: tableData[obj.menuTwo].goodsCols || goodsCols,
                callback: function () {
                    //筛选
                    layui.use('form', function() {
                        var form = layui.form;
                        form.on('submit(search)', function (data) {
                            where.goods_name = data.field.goods_name;
                            table.reload({
                                page: {
                                    curr: 1
                                },
                                where: where
                            });
                            return false;
                        });
                    });
                }
            });
        }
        else if (obj.type == 3){
            var html = '';
            html += '<div class="layui-form custom-link">';
                html += '<div class="layui-form-item">';
                    html += '<label class="layui-form-label sm"><span class="required">*</span>链接名称</label>';
                    html += '<div class="layui-input-inline">';
                        html += `<input type="text" name="title" class="layui-input ns-len-mid" value="${!link.temporayLink.name && link.currentLink.menuOne == "CUSTOM_LINK" ? link.temporayLink.title : '' }" required>`;
                    html += '</div>';
                html += '</div>';
                html += '<div class="layui-form-item">';
                    html += '<label class="layui-form-label sm"><span class="required">*</span>跳转路径</label>';
                    html += '<div class="layui-input-block">';
                        html += `<input type="text" name="wap_url" class="layui-input ns-len-mid" value="${!link.temporayLink.name && link.currentLink.menuOne == "CUSTOM_LINK" ? link.temporayLink.wap_url : ''}">`;
                    html += '</div>';
                    html += '<div class="ns-word-aux sm">路径必须以“/”开头，例：“/pages/goods/list/list”</div>';
                html += '</div>';
            html += '</div>';

            $(".link-right").html(html);
        }
        else if(obj.type == 4){
            var html = '';
            html += `<div id="category_list" lay-filter="category_list"></div>`;
            $(".link-right").html(html);

            layui.use(['laytpl', 'form'], function(){
                var laytpl = layui.laytpl,
                    form = layui.form;

                laytpl($("#category_html").html()).render([], function(html) {
                    $("#category_list").html(html);

                    //展开收齐点击事件
                    $(".js-switch").click(function () {
                        var category_id = $(this).attr("data-category-id");
                        var level = $(this).attr("data-level");
                        var open = parseInt($(this).attr("data-open").toString());

                        if(open){
                            $(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").hide();
                            $(this).text("+");
                        }else{
                            $(".goods-category-list .layui-table tr[data-category-id-"+ level+"='" + category_id + "']").show();
                            $(this).text("-");
                        }
                        $(this).attr("data-open", (open ? 0 : 1));
                    });


                    if ($("input[name='category_select_id']:checked").length > 0){
                        var category_id_1 = $("input[name='category_select_id']:checked").parents('.category-line').attr('data-category-id-1');
                        var category_id_2 = $("input[name='category_select_id']:checked").parents('.category-line').attr('data-category-id-2');
                        if(category_id_1 > 0){
                            $('tr[data-category-id-1='+category_id_1+']').show();
                        }
                        if(category_id_2 > 0){
                            $('tr[data-category-id-2='+category_id_2+']').show();
                        }
                    }
                    // 勾选分类
                    form.on('checkbox(category_select_id)', function(data) {
                        if (data.elem.checked){
                            $("input[name='category_select_id']:checked").prop("checked",false);
                            $(data.elem).prop("checked",true);
                            form.render();

                            var categoryData = JSON.parse($(data.elem).val());
                            link.temporayLink.name = categoryData.category_id;
                            link.temporayLink.title = categoryData.category_name;
                            link.temporayLink.wap_url = '/pages/goods/list/list?category_id=' + categoryData.category_id;
                        }
                    });
                    form.render();
                });
            });
        }
    }

    //保存
    $(".link-box .link-save").click(function(){
        if (link.temporayLink.menuOne == "CUSTOM_LINK") setCustomLink();
        window.linkData = link.temporayLink.wap_url ? link.temporayLink : link.currentLink;
        layer.close(window.linkIndex);
    });

    //点击清空按钮
    $(".link-btn .link-eliminate").click(function () {
        //重置数据
        window.linkData = {parent:'MALL_PAGE',childer:'MALL_LINK',name:'',title:'',wap_url:''};
        layer.close(window.linkIndex);
    });

    //左侧一级菜单
    $(".link-box .link-left dt").click(function () {
        var menuOneIdent = $(this).attr('data-ident');
        link.temporayLink.menuOne = menuOneIdent;

        if (menuOneIdent == 'CUSTOM_LINK'){
            link.temporayLink.type = 3;
            initData(link.temporayLink);
        }
        else if(menuOneIdent == 'MALL_PAGE')
            link.temporayLink.type = 1;
        else
            link.temporayLink.type = 2;

        initMenu(link.temporayLink);
    });

    //左侧二级菜单
    $(".link-box .link-left dd").click(function () {
        link.temporayLink.menuTwo = $(this).attr('data-ident');
        link.temporayLink.menuOne = $(this).parents('dl').find('dt').attr('data-ident');
        if (link.temporayLink.menuTwo == "GOODS_CATEGORY")
            link.temporayLink.type = 4;
        else if(link.temporayLink.menuOne == 'MALL_PAGE' && link.temporayLink.menuTwo != "GOODS_CATEGORY"){
            link.temporayLink.type = 1;
        }
        initMenu(link.temporayLink);
        initData(link.temporayLink);
    });

    //点击菜单
    $("body").on("click", ".link-box .link-right dd", function () {
        $(".link-box .link-right dd").removeClass("ns-border-color");
        if (!$(this).hasClass("ns-border-color")) $(this).addClass("ns-border-color");

        var data = JSON.parse($(this).attr("data-value"));
        link.temporayLink.wap_url = data.wap_url;
        link.temporayLink.name = data.name;
        link.temporayLink.title = data.title;
    });

    //操作表格
    layui.use('form',function () {
        var form = layui.form;
        form.on('checkbox(goods_checkbox)', function(data) {
            if (data.elem.checked){
                $("input[name='goods_checkbox']:checked").prop("checked",false);
                $(data.elem).prop("checked",true);
                form.render();

                var goodsJson = $(data.elem).attr("data-goods_json") ? JSON.parse($(data.elem).attr("data-goods_json")) : {};
                link.temporayLink.title = goodsJson.goods_name || goodsJson.game_type_name;
                link.temporayLink.wap_url = tableData[link.temporayLink.menuTwo].wap_url + goodsJson[tableData[link.temporayLink.menuTwo].select_id];
                link.temporayLink.name = {[link.temporayLink.menuTwo] : goodsJson[tableData[link.temporayLink.menuTwo].select_id]};
            }
        });
    });

    //设置自定义链接
    function setCustomLink(){
        if (!$(".custom-link input[name='title']").val()){
            layer.msg("链接名称不能为空");
            return false;
        }
        if (!$(".custom-link input[name='wap_url']").val()){
            layer.msg("跳转路径不能为空");
            return false;
        }
        link.temporayLink.name = '';
        link.temporayLink.title = $(".custom-link input[name='title']").val();
        link.temporayLink.wap_url = $(".custom-link input[name='wap_url']").val();
    }
</script>

<!-- 商品复选框 -->
<script type="text/html" id="checkbox">
    {{# if(tableData[link.temporayLink.menuTwo] && link.temporayLink.name[link.temporayLink.menuTwo] == d[tableData[link.temporayLink.menuTwo].select_id]){ }}
    <input type="checkbox" name="goods_checkbox" data-goods_json='{{ JSON.stringify(d) }}' lay-skin="primary" lay-filter="goods_checkbox" checked>
    {{# }else{ }}
    <input type="checkbox" name="goods_checkbox" data-goods_json='{{ JSON.stringify(d) }}' lay-skin="primary" lay-filter="goods_checkbox">
    {{# } }}
</script>

<!-- 商品信息 -->
<script type="text/html" id="goods_info">
    <div class="ns-table-title">
        <div class="ns-title-pic" id="goods_img_{{d.goods_id}}">
            <img layer-src src="{{ns.img(d.goods_image.split(',')[0], 'small')}}"/>
        </div>
        <div class="ns-title-content">
            <a href="javascript:;" class="ns-multi-line-hiding ns-text-color" title="{{d.goods_name}}">{{d.goods_name}}</a>
        </div>
    </div>
</script>

<!-- 游戏状态 -->
<script type="text/html" id="game_status">
    {{#  if(d.status == 0){  }}
    未开始
    {{#  }else if(d.status == 1){  }}
    进行中
    {{#  }else if(d.status == 2){  }}
    已结束
    {{#  }else if(d.status == 3){  }}
    已关闭
    {{#  }  }}
</script>

<!-- 商品分类 -->
<script type="text/html" id="category_html">
    <div class="goods-category-list layui-form">
        <table class="layui-table ns-pithy-table">
            <colgroup>
                <col width="5%">
                <col width="3%">
                <col width="37%">
                <col width="25%">
                <col width="30%">
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>分类名称</th>
                <th>简称</th>
                <th>图片</th>
            </tr>
            </thead>
            <tbody>
            <?php if($category_list): if(is_array($category_list) || $category_list instanceof \think\Collection || $category_list instanceof \think\Paginator): if( count($category_list)==0 ) : echo "" ;else: foreach($category_list as $key=>$vo): ?>
            <tr class='category-line'>
                <td>
                    {{# if(link.temporayLink.name && link.temporayLink.name == <?php echo htmlentities($vo['category_id']); ?>){ }}
                    <input type="checkbox" name="category_select_id" data-category_select_id = "<?php echo htmlentities($vo['category_id']); ?>" lay-skin="primary" value='<?php echo json_encode($vo); ?>' lay-filter="category_select_id" checked>
                    {{# }else{ }}
                    <input type="checkbox" name="category_select_id" data-category_select_id = "<?php echo htmlentities($vo['category_id']); ?>" lay-skin="primary" value='<?php echo json_encode($vo); ?>' lay-filter="category_select_id">
                    {{# } }}
                </td>
                <td>
                    <?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): ?>
                    <span class="switch ns-text-color js-switch" data-category-id="<?php echo htmlentities($vo['category_id']); ?>" data-level="<?php echo htmlentities($vo['level']); ?>" data-open="0">+</span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlentities($vo['category_name']); ?></td>
                <td><?php echo htmlentities($vo['short_name']); ?></td>
                <td>
                    <?php if(!(empty($vo['image']) || (($vo['image'] instanceof \think\Collection || $vo['image'] instanceof \think\Paginator ) && $vo['image']->isEmpty()))): ?>
                    <div class="ns-img-box">
                        <img layer-src src="<?php echo img($vo['image']); ?>"/>
                    </div>
                    <?php endif; ?>
                </td>

            </tr>
            <?php if(!(empty($vo['child_list']) || (($vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator ) && $vo['child_list']->isEmpty()))): if(is_array($vo['child_list']) || $vo['child_list'] instanceof \think\Collection || $vo['child_list'] instanceof \think\Paginator): if( count($vo['child_list'])==0 ) : echo "" ;else: foreach($vo['child_list'] as $key=>$second): ?>
            <tr class='category-line' data-category-id-1="<?php echo htmlentities($second['category_id_1']); ?>" style="display:none;">
                <td>
                    {{# if(link.temporayLink.name && link.temporayLink.name == <?php echo htmlentities($second['category_id']); ?>){ }}
                    <input type="checkbox" name="category_select_id" lay-skin="primary" data-category_select_id = "<?php echo htmlentities($second['category_id']); ?>" value='<?php echo json_encode($second); ?>' lay-filter="category_select_id" checked>
                    {{# }else{ }}
                    <input type="checkbox" name="category_select_id" lay-skin="primary" data-category_select_id = "<?php echo htmlentities($second['category_id']); ?>" value='<?php echo json_encode($second); ?>' lay-filter="category_select_id">
                    {{# } }}
                </td>
                <td></td>
                <td style="padding-left: 20px;">
                    <span class="switch ns-text-color js-switch" data-category-id="<?php echo htmlentities($second['category_id']); ?>" data-level="<?php echo htmlentities($second['level']); ?>" data-open="1" style="padding-right: 20px;">-</span>
                    <span><?php echo htmlentities($second['category_name']); ?></span>
                </td>
                <td><?php echo htmlentities($second['short_name']); ?></td>
                <td>
                    <?php if(!(empty($second['image']) || (($second['image'] instanceof \think\Collection || $second['image'] instanceof \think\Paginator ) && $second['image']->isEmpty()))): ?>
                    <img layer-src src="<?php echo img($second['image']); ?>"/>
                    <?php endif; ?>
                </td>
            </tr>
            <?php if(!(empty($second['child_list']) || (($second['child_list'] instanceof \think\Collection || $second['child_list'] instanceof \think\Paginator ) && $second['child_list']->isEmpty()))): if(is_array($second['child_list']) || $second['child_list'] instanceof \think\Collection || $second['child_list'] instanceof \think\Paginator): if( count($second['child_list'])==0 ) : echo "" ;else: foreach($second['child_list'] as $key=>$third): ?>
            <tr class='category-line' data-category-id-1="<?php echo htmlentities($third['category_id_1']); ?>" data-category-id-2="<?php echo htmlentities($third['category_id_2']); ?>" style="display:none;">
                <td>
                    {{# if(link.temporayLink.name && link.temporayLink.name == <?php echo htmlentities($third['category_id']); ?>){ }}
                    <input type="checkbox" name="category_select_id" lay-skin="primary" value='<?php echo json_encode($third); ?>' data-category_select_id = '<?php echo htmlentities($third['category_id']); ?>'lay-filter="category_select_id" checked>
                    {{# }else{ }}
                    <input type="checkbox" name="category_select_id" lay-skin="primary" value='<?php echo json_encode($third); ?>' data-category_select_id = '<?php echo htmlentities($third['category_id']); ?>'lay-filter="category_select_id">
                    {{# } }}
                </td>
                <td></td>
                <td style="padding-left: 80px;">
                    <span><?php echo htmlentities($third['category_name']); ?></span>
                </td>
                <td><?php echo htmlentities($third['short_name']); ?></td>
                <td>
                    <?php if(!(empty($third['image']) || (($third['image'] instanceof \think\Collection || $third['image'] instanceof \think\Paginator ) && $third['image']->isEmpty()))): ?>
                    <img layer-src src="<?php echo img($third['image']); ?>"/>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; else: ?>
            <tr>
                <td colspan="9" style="text-align: center">无数据</td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</script>