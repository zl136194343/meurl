var laytpl, form, element, repeat_flag = false, table;
$(function () {
    layui.use(['form', 'laytpl', 'element'], function () {
        form = layui.form;
        repeat_flag = false; //防重复标识
        element = layui.element;
        laytpl = layui.laytpl;

        //商品品牌


        //商品类型
        // goodsSattr();

        refreshTable(0);

        //监听Tab切换，以改变地址hash值
        element.on('tab(goods_list_tab)', function () {
            var id = this.getAttribute('lay-id');
            var type = this.getAttribute('data-type');
            $("input[name='goods_state']").val("");
            $("input[name='verify_state']").val("");
            if (type) {
                $("input[name='" + type + "']").val(id);
            }

            $("#batchOperation").html("");
            if (type == "goods_state" && (id == 1 || id == 0)) {
                // 销售中、仓库中状态：违规下架
                $("#batchOperation").html('<button class="layui-btn layui-btn-primary" lay-event="lockup">违规下架</button>');
                $("input[name='verify_state']").val(1);
            } else if (type == "verify_state" && id == 0) {
                // 待审核状态：通过、拒绝
                $("#batchOperation").html('<button class="layui-btn layui-btn-primary" lay-event="verify_on">审核通过</button><button class="layui-btn layui-btn-primary" lay-event="verify_off">审核拒绝</button>');
            }

            // 全部
            refreshTable(0);
        });

        // 监听工具栏操作
        table.tool(function (obj) {
            var data = obj.data;
            switch (obj.event) {
                case 'select': //推广
                    goodsUrl(data);
                    break;
                case 'preview': //预览
                    goodsPreview(data);
                    break;
                case 'lockup': //违规下架
                    lockup(data.goods_id);
                    break;
                case 'verify_on':
                    //审核通过
                    verifyOn(data.goods_id, 1);
                    break;
                case 'verify_off':
                    //审核失败
                    verifyOn(data.goods_id, -2);
                    break;
                case 'select_verify_remark':
                    getVerifyStateRemark(data.goods_id, -2);
                    break;
                case 'select_violations_remark':
                    getVerifyStateRemark(data.goods_id, 10);
                    break;
                case 'browse_records':
                    location.href = ns.url("admin/goods/goodsBrowse", {goods_id: data.goods_id});
                    break;
            }
        });

        // 批量操作
        table.bottomToolbar(function (obj) {
            if (obj.data.length < 1) {
                layer.msg('请选择要操作的数据');
                return;
            }

            var id_array = new Array();
            for (i in obj.data) id_array.push(obj.data[i].goods_id);
            switch (obj.event) {

                case 'lockup': //违规下架
                    lockup(id_array.toString());
                    break;
                case 'verify_on': //审核通过

                    verifyOn(id_array.toString(), 1);
                    break;
                case 'verify_off': //审核失败

                    verifyOn(id_array.toString(), -2);
                    break;
                case 'recommend_way'://推荐方式
                    settingRecommendWay(id_array.toString());
                    break;
            }
        });

        table.toolbar(function (obj) {
            if (obj.data.length < 1) {
                layer.msg('请选择要操作的数据');
                return;
            }

            var id_array = new Array();
            for (i in obj.data) id_array.push(obj.data[i].goods_id);
            switch (obj.event) {

                case 'lockup': //违规下架
                    lockup(id_array.toString());
                    break;
                case 'verify_on':
                    //审核通过
                    verifyOn(id_array.toString(), 1);
                    break;
                case 'verify_off':
                    //审核失败
                    verifyOn(id_array.toString(), -2);
                    break;
                case 'recommend_way'://推荐方式
                    settingRecommendWay(id_array.toString());
                    break;
            }
        });

        table.on("sort", function (obj) {
            table.reload({
                page: {
                    curr: 1
                },
                where: {
                    order: obj.field,
                    sort: obj.type
                }
            });
        });

        // 搜索功能
        form.on('submit(search)', function (data) {
            table.reload({
                page: {
                    curr: 1
                },
                where: data.field
            });
            refreshVerifyStateCount();
            return false;
        });

         //修改商品推荐方式
        form.on('submit(set_recommend_way)', function (data) {

            $.ajax({
                type: "POST",
                url: ns.url("admin/goods/modifyGoodsRecommendWay"),
                data:  data.field,
                dataType: 'JSON',
                success: function (res) {
                    layer.msg(res.message);
                    if (res.code >= 0) {
                        layer.closeAll();
                    }
                }
            })

        });
    });

});

/**
 * 刷新表格列表
 * @param status 状态：0 全部，1 销售中、仓库中，2 待审核，3 审核失败、违规下架
 */
function refreshTable(status) {

    // 全部
    var cols = [
        [
            {
            title: 'id',
            unresize: 'false',
            width: '3%',
            field: 'id',
        }, {
            field: 'position_name',
            title: '职位名称',
            unresize: 'false',
            width: '10%',
        },{
            field: 'sort',
            unresize: 'false',
            title: `<div class="ns-prompt-block">排序</div>`,
            width: '7%',

        },{
            field: 'company_id',
            unresize: 'false',
            title: `<div class="ns-prompt-block">对应公司id</div>`,
            width: '7%',
        },{
            title: '状态',
            unresize: 'false',
            width: '6%',
            templet:  function (data) {
                if (data.is_shown == 0) {
                    return '<spam>上架</spam>';
                }else{
                    return '<spam>下架</spam>';
                }
            }
        },  {
            title: '创建时间',
            unresize: 'false',
            width: '10%',
            templet: function (data) {
                return '<span title="' + ns.time_to_date(data.create_time) + '">' + ns.time_to_date(data.create_time) + '</span>';
            }
        }, {
            title: '操作',
            toolbar: '#action',
            unresize: 'false',
            width: '10%'
        }]
    ];


    table = new Table({
        elem: '#goods_list',
        url: ns.url("admin/company/position"),
        cols: cols,
        where: {
            search_text: $("input[name='search_text']").val(),
            search_text_type: $("select[name='search_text_type'] option:checked").val(),

        }
    });


}
$(".reset").click(function () {
    $("input[name='category_id']").val('')
})
//审核商品
function verifyOn(goods_ids, verify_state) {
    if (verify_state === -2) {
        // 拒绝
        layer.prompt({
            formType: 2,
            title: '审核拒绝原因',
            cancel: function (index, layero) {
                repeat_flag = false;
            },
            end: function () {
                repeat_flag = false;
            }
        }, function (value, index, elem) {

            if (repeat_flag) return;
            repeat_flag = true;
            layer.close(index);

            $.ajax({
                url: ns.url("admin/goods/verifyOn"),
                data: {
                    goods_ids: goods_ids.toString(),
                    verify_state: verify_state,
                    verify_state_remark: value
                },
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    layer.msg(res.message);
                    repeat_flag = false;
                    if (res.code == 0) {
                        table.reload();
                        refreshVerifyStateCount();
                    }
                }
            });
        });
    } else {

        layer.confirm('确定审核通过吗?', function () {
            if (repeat_flag) return;
            repeat_flag = true;
            layer.close(index);

            $.ajax({
                url: ns.url("admin/goods/verifyOn"),
                data: {
                    goods_ids: goods_ids.toString(),
                    verify_state: verify_state
                },
                dataType: 'JSON',
                type: 'POST',
                success: function (res) {
                    layer.msg(res.message);
                    repeat_flag = false;
                    if (res.code == 0) {
                        table.reload();
                        refreshVerifyStateCount();
                    }
                }
            });
        });
    }

}

//商品违规下架
function lockup(goods_ids) {

    layer.confirm('确定要删除吗?', function() {
        $.ajax({
            url: ns.url("admin/company/delete"),
            data: {category_id : category_id},
            dataType: 'JSON',
            type: 'POST',
            async: false,
            success: function (res) {
                layer.msg(res.message);
                if (res.code == 0) {
                    location.reload();
                }
            }
        });
    });

}

// 商品推广
function goodsUrl(data) {
    $(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").show();
    $('#goods_name').html(data.goods_name);
    $.ajax({
        type: "POST",
        url: ns.url("admin/goods/goodsUrl"),
        data: {
            'goods_id': data.goods_id
        },
        dataType: 'JSON',
        success: function (res) {
            if (res.data.path.h5.status == 1) {
                res.data.goods_id = data.goods_id;
                laytpl($("#goods_url").html()).render(res.data, function (html) {
                    $(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").html(html).show();

                    $("body").click(function (e) {
                        if (!$(e.target).closest(".popup-qrcode-wrap").length) {
                            $(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").hide();
                        }
                    });
                });
            } else {
                layer.msg(res.data.path.h5.message);
                $(".operation-wrap[data-goods-id='" + data.goods_id + "'] .popup-qrcode-wrap").hide();
            }
        }
    });
}

/**
 * 设置商品推荐方式
 */
function settingRecommendWay(data) {

    laytpl($("#recommend_way").html()).render(data, function(html) {
        layer_label = layer.open({
            title: '设置商品推荐方式',
            skin: 'layer-tips-class',
            type: 1,
            area: ['450px'],
            content: html,
        });
    });

    form.render();
}


// 商品预览
var isOpenGoodsPreviewPopup = false;//防止重复弹出商品预览框
function goodsPreview(data) {
    if (isOpenGoodsPreviewPopup) return;
    isOpenGoodsPreviewPopup = true;
    $.ajax({
        type: "POST",
        url: ns.url("admin/goods/goodsPreview"),
        data: {
            'goods_id': data.goods_id
        },
        dataType: 'JSON',
        success: function (res) {
            if (res.data.path.h5.status == 1) {
                res.data.goods_id = data.goods_id;

                laytpl($("#goods_preview").html()).render(res.data, function (html) {
                    var layerIndex = layer.open({
                        title: '商品预览',
                        skin: 'layer-tips-class',
                        type: 1,
                        area: ['600px', '600px'],
                        content: html,
                        success: function () {
                            isOpenGoodsPreviewPopup = false;
                        }
                    });
                });
            } else {
                layer.msg(res.data.path.h5.message);
            }
        }
    });
}

/**
 * 获取商品违规或审核失败说明
 * @param goods_id
 * @param verify_state
 */
function getVerifyStateRemark(goods_id, verify_state) {
    if (repeat_flag) return;
    repeat_flag = true;
    $.ajax({
        url: ns.url("admin/goods/getVerifyStateRemark"),
        data: {goods_id: goods_id},
        dataType: 'JSON',
        type: 'POST',
        success: function (res) {
            var data = res.data;
            if (data) {
                var title = '';
                if (verify_state == -2) title = '审核失败原因';
                else title = '违规下架原因';
                layer.open({
                    title: title,
                    content: data.verify_state_remark,
                    cancel: function (index, layero) {
                        repeat_flag = false;
                    },
                    end: function () {
                        repeat_flag = false;
                    },
                    yes: function (index, layero) {
                        repeat_flag = false;
                        layer.close(index);
                    }
                });
            }
        }
    });
}

//商品品牌
function goodsBrand() {
    var brandHtml = "";
    $.ajax({
        url: ns.url("admin/goodsbrand/lists"),
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {
            brandHtml += '<option value="">全部</option>';
            $.each(res.data.list, function (key, val) {
                brandHtml += '<option value="' + val.brand_id + '">' + val.brand_name + '</option>';
            });
            $("select[name='goods_brand']").html(brandHtml);
            form.render('select');
        }
    });
}

//商品类型
function goodsSattr() {
    var sattrHtml = "";
    $.ajax({
        url: ns.url("admin/goodsattr/lists"),
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {
            sattrHtml += '<option value="">全部</option>';
            $.each(res.data.list, function (key, val) {
                sattrHtml += '<option value="${val.class_id}">${val.class_name}</option>';
            });
            $("select[name='goods_attr_class']").html(sattrHtml);
            form.render('select');
        }
    });
}

// 刷新审核状态商品数量
function refreshVerifyStateCount() {
    $.ajax({
        url: ns.url("admin/goods/refreshVerifyStateCount"),
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {
            for (var i = 0; i < res.length; i++) {
                if (res[i].count) $('div[lay-filter="goods_list_tab"] li[data-type="verify_state"][lay-id="' + res[i].state + '"] span.count').text(res[i].count).show();
                else $('div[lay-filter="goods_list_tab"] li[data-type="verify_state"][lay-id="' + res[i].state + '"] span').hide();
            }
        }
    });
}


// 监听单元格编辑
function editSort(goods_id, event){
    var data = $(event).val();

    if (data == '') {
        $(event).val(0);
        data = 0;
    }

    if(!new RegExp("^-?[0-9]\\d*$").test(data)){
        layer.msg("权重值只能是整数");
        return ;
    }
    if(data<0){
        layer.msg("权重值必须大于0");
        return ;
    }
    $.ajax({
        type: 'POST',
        url: ns.url("admin/goods/modifySort"),
        data: {
            goods_id: goods_id,
            sort: data
        },
        dataType: 'JSON',
        success: function(res) {
            layer.msg(res.message);
            if(res.code==0){
                table.reload();
            }
        }
    });
}