<?php
// +----------------------------------------------------------------------
// | 平台端菜单设置
// +----------------------------------------------------------------------


return [
    [
        'name'           => 'COMMUNITY_LEADER_ROOT',
        'title'          => '团长',
        'url'            => 'community://shop/community/lists',
        'parent'         => 'COMMUNITY_ROOT',
        'is_show'        => 1,
        'is_control'     => 1,
        'is_icon'        => 0,
        'sort'           => 100,
        'child_list' => [
							[
								'name' => 'COMMUNITY_LEADER_LISTS',
								'title' => '团长列表',
								'url' => 'community://shop/community/lists',
								'is_show' => 1,
							],
							[
								'name' => 'COMMUNITY_LEADER_ADD',
								'title' => '添加团长',
								'url' => 'community://shop/community/addleader',
								'is_show' => 0, 
							],
                            [
                                'name' => 'COMMUNITY_LEADER_ACCOUNT',
                                'title' => '账户明细',
                                'url' => 'community://shop/community/accountlist',
                                'is_show' => 0,
                            ],
							[
								'name' => 'COMMUNITY_LEVEL',
								'title' => '团长等级',
								'url' => 'community://shop/community/levellist',
								'is_show' => 1,
							],
							[
								'name' => 'COMMUNITY_LEVEL_ADD',
								'title' => '等级添加',
								'url' => 'community://shop/community/addlevel',
								'is_show' => 0,
								'child_list' => [
    								    [
    								        'name' => 'COMMUNITY_LEVEL_EDIT',
            								'title' => '等级修改',
            								'url' => 'community://shop/community/editlevel',
            								'is_show' => 0,
    								    ],
    								    [
    								        'name' => 'COMMUNITY_LEVEL_DELETE',
            								'title' => '删除等级',
            								'url' => 'community://shop/community/deletelevel',
            								'is_show' => 0,
    								    ]
								     ],
							],
							[
								'name' => 'COMMUNITY_CONFIG',
								'title' => '团长设置',
								'url' => 'community://shop/community/config',
								'is_show' => 1,
							],
							[
								'name' => 'COMMUNITY_AGREEMENT_CONFIG',
								'title' => '入驻协议',
								'url' => 'community://shop/community/agreementconfig',
								'is_show' => 1,
							],
							[
								'name' => 'COMMUNITY_LEADER_APPLY_LIST',
								'title' => '入驻申请',
								'url' => 'community://shop/community/leaderapplylist',
								'is_show' => 1,
							],
        					[
        						'name' => 'COMMUNITY_LEADER_AUDIT_PASS',
        						'title' => '审核通过',
        						'url' => 'community://shop/community/auditpass',
        						'is_show' => 0,
        					],
        					[
        						'name' => 'COMMUNITY_LEADER_AUDIT_REFUSE',
        						'title' => '审核拒绝',
        						'url' => 'community://shop/community/auditrefuse',
        						'is_show' => 0,
        					],
        					[
        						'name' => 'COMMUNITY_LEADER_FREEZE',
        						'title' => '冻结账号',
        						'url' => 'community://shop/community/freezeleader',
        						'is_show' => 0,
        					],
        					[
        						'name' => 'COMMUNITY_LEADER_RECOVER',
        						'title' => '恢复账号',
        						'url' => 'community://shop/community/freezeleader',
        						'is_show' => 0,
        					],
        					
        					[
                                'name'           => 'COMMUNITY_WITHDRAW_ROOT',
                                'title'          => '提现管理',
                                'url'            => 'community://shop/community/withdrawlist',
                                'is_show'        => 1,
                                'child_list' => [
                                                [
                                        			'name' => 'COMMUNITY_WITHDRAW_PASS',
                                        			'title' => '审核通过',
                                        			'url' => 'community://shop/community/withdrawpass',
                                        						'is_show' => 1,
                                        		],
                                        		[
                                        			'name' => 'COMMUNITY_WITHDRAW_REFUSE',
                                        			'title' => '审核拒绝',
                                        			'url' => 'community://shop/community/withdrawrefuse',
                                        						'is_show' => 1,
                                        		],
                                    ]
                            ],
        					
						]

    ],
    [
        'name'           => 'COMMUNITY_ORDER_ROOT',
        'title'          => '订单',
        'url'            => 'community://shop/order/lists',
        'parent'         => 'COMMUNITY_ROOT',
        'is_show'        => 1,
        'is_control'     => 1,
        'is_icon'        => 0,
        'sort'           => 100,
        'child_list' => [
							[
								'name' => 'COMMUNITY_ORDER_MANAGE',
								'title' => '订单管理',
								'url' => 'community://shop/order/lists',
								'is_show' => 1,
								'child_list' =>[
								        [
            								'name' => 'COMMUNITY_ORDER_EXPRESS_ORDER_DETAIL',
            								'title' => '订单详情',
            								'url' => 'community://shop/order/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_EXPORT_LIST',
            								'title' => '订单导出记录',
            								'url' => 'community://shop/order/close',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_EXPRESS_ORDER_DELIVER',
            								'title' => '订单发货',
            								'url' => 'community://shop/order/deliver',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_EXPRESS_ORDER_ADJUST_PRICE',
            								'title' => '订单调价',
            								'url' => 'community://shop/order/adjustprice',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_REMARK',
            								'title' => '订单备注',
            								'url' => 'community://shop/order/orderRemark',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'ORDER_DELETE',
            								'title' => '订单删除',
            								'url' => 'community://shop/order/delete',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_EXPRESS_ORDER_EDIT_ADDRESS',
            								'title' => '订单修改收货地址',
            								'url' => 'community://shop/order/editaddress',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_LOCAL_ORDER_DETAIL',
            								'title' => '外卖订单详情',
            								'url' => 'community://shop/localorder/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_EXPRESS_ORDER_DETAIL',
            								'title' => '订单详情',
            								'url' => 'community://shop/order/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_LOCAL_ORDER_DELIVER',
            								'title' => '外卖订单发货',
            								'url' => 'community://shop/localorder/delivery',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'EXPRESS_ORDER_DETAIL',
            								'title' => '订单详情',
            								'url' => 'community://shop/order/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_STORE_ORDER_DETAIL',
            								'title' => '自提订单详情',
            								'url' => 'community://shop/storeorder/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'VIRTUAL_ORDER_DETAIL',
            								'title' => '虚拟订单详情',
            								'url' => 'community://shop/virtualorder/detai',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_TAKE_DELIVERY',
            								'title' => '确认收货',
            								'url' => 'community://shop/order/detail',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_DELIVERY',
            								'title' => '发货',
            								'url' => 'community://shop/order/delivery',
            								'is_show' => 1,
								        ],
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_BATCH_DELIVERY',
            								'title' => '批量发货',
            								'url' => 'community://shop/delivery/batchdelivery',
            								'is_show' => 1,
								        ],
							],
							],
							[
								'name' => 'COMMUNITY_DELIVERY_ORDER_LIST',
								'title' => '配送单管理',
								'url' => 'community://shop/communitydelivery/orderlist',
								'is_show' => 1, 
								'child_list' =>[
        						        [
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_DELIVERY',
                    						'title' => '配送单配送',
                    						'url' => 'community://shop/communitydelivery/orderdelivery',
                    						'is_show' => 0,
                    					],
                    					[
            						        'name' => 'COMMUNITY_LEADER_FREEZE',
                    						'title' => '配送单送达',
                    						'url' => 'community://shop/communitydelivery/ordercomplete',
                    						'is_show' => 0,
                    					],
                    					[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_UPDATE',
                    						'title' => '更新配送单',
                    						'url' => 'community://shop/communitydelivery/updateorder',
                    						'is_show' => 0,
                    					],[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_EXPORT',
                    						'title' => '配送单导出',
                    						'url' => 'community://shop/communitydelivery/exportorder',
                    						'is_show' => 0,
                    					],[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_DELETE',
                    						'title' => '删除配送单',
                    						'url' => 'community://shop/communitydelivery/deleteorder',
                    						'is_show' => 0,
                    					],[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_DETAIL',
                    						'title' => '配送单详情',
                    						'url' => 'community://shop/communitydelivery/orderdetail',
                    						'is_show' => 0,
                    					],[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_EXPORT_LIST',
                    						'title' => '配送单导出',
                    						'url' => 'community://shop/communitydelivery/exportlist',
                    						'is_show' => 0,
                    					],[
            						        'name' => 'COMMUNITY_DELIVERY_ORDER_EXPORT_RESET',
                    						'title' => '重执配送单导出记录',
                    						'url' => 'community://shop/communitydelivery/resetexport',
                    						'is_show' => 0,
                    					],
        						    ]
							],
                            
        					[
        						'name' => 'COMMUNITY_ORDER_ORDER_REFUND_LIST',
        						'title' => '退款维权',
        						'url' => 'community://shop/orderrefund/lists',
        						'is_show' => 1,
        						'child_list' =>[
								        [
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_DETAIL',
            								'title' => '维权详情',
            								'url' => 'community://shop/orderrefund/detail',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_REFUSE',
            								'title' => '维权拒绝',
            								'url' => 'community://shop/orderrefund/refuse',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_AGREE',
            								'title' => '维权同意',
            								'url' => 'community://shop/orderrefund/agree',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_AGREE',
            								'title' => '维权收货',
            								'url' => 'community://shop/orderrefund/receive',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_COMPLETE',
            								'title' => '维权通过',
            								'url' => 'community://shop/orderrefund/complete',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_EXPORT_LIST',
            								'title' => '订单维权导出记录',
            								'url' => 'community://shop/orderrefund/exportT',
            								'is_show' => 1,
								        ],[
            								'name' => 'COMMUNITY_ORDER_ORDER_REFUND_CLOSE',
            								'title' => '关闭维权',
            								'url' => 'community://shop/orderrefund/close',
            								'is_show' => 1,
								        ],
							    ],
        					],
						]
					
		        
		],
    
];
    
