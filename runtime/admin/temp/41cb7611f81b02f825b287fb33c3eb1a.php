<?php /*a:1:{s:76:"/www/wwwroot/ls.chnssl.com/app/admin/view/consulting/xiumi-ue-dialog-v5.html";i:1654586162;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0047)https://ent.xiumi.us/ue/xiumi-ue-dialog-v5.html -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>XIUMI connect</title>
    <style>
        html,
        body {
            padding: 0;
            margin: 0;
        }
        
        #xiumi {
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <iframe id="xiumi" src="//xiumi.us/studio/v5#/paper" style="margin-top: 100px;" v-show="showXiumi">
    </iframe>

    <script>
        (function() {
            var parent = window.parent;
            //dialog对象
            dialog = parent.$EDITORUI[window.frameElement.id.replace(/_iframe$/, '')];
            //当前打开dialog的编辑器实例
            editor = dialog.editor;

            UE = parent.UE;

            domUtils = UE.dom.domUtils;

            utils = UE.utils;

            browser = UE.browser;

            ajax = UE.ajax;

            $G = function(id) {
                return document.getElementById(id)
            };
            //focus元素
            $focus = function(node) {
                setTimeout(function() {
                    if (browser.ie) {
                        var r = node.createTextRange();
                        r.collapse(false);
                        r.select();
                    } else {
                        node.focus()
                    }
                }, 0)
            };
            utils.loadFile(document, {
                href: editor.options.themePath + editor.options.theme + "/dialogbase.css?cache=" + Math.random(),
                tag: "link",
                type: "text/css",
                rel: "stylesheet"
            });
            lang = editor.getLang(dialog.className.split("-")[2]);
            if (lang) {
                domUtils.on(window, 'load', function() {

                    var langImgPath = editor.options.langPath + editor.options.lang + "/images/";
                    //针对静态资源
                    for (var i in lang["static"]) {
                        var dom = $G(i);
                        if (!dom) continue;
                        var tagName = dom.tagName,
                            content = lang["static"][i];
                        if (content.src) {
                            //clone
                            content = utils.extend({}, content, false);
                            content.src = langImgPath + content.src;
                        }
                        if (content.style) {
                            content = utils.extend({}, content, false);
                            content.style = content.style.replace(/url\s*\(/g, "url(" + langImgPath)
                        }
                        switch (tagName.toLowerCase()) {
                            case "var":
                                dom.parentNode.replaceChild(document.createTextNode(content), dom);
                                break;
                            case "select":
                                var ops = dom.options;
                                for (var j = 0, oj; oj = ops[j];) {
                                    oj.innerHTML = content.options[j++];
                                }
                                for (var p in content) {
                                    p != "options" && dom.setAttribute(p, content[p]);
                                }
                                break;
                            default:
                                domUtils.setAttributes(dom, content);
                        }
                    }
                });
            }


        })();
    </script>
    <script>
        var xiumi = document.getElementById('xiumi');
        var xiumi_url = window.location.protocol + "//xiumi.us";
        console.log("xiumi_url is %o", xiumi_url);
        xiumi.onload = function() {
            console.log("postMessage to %o", xiumi_url);
            // "XIUMI:3rdEditor:Connect" 是特定标识符，不能修改，大小写敏感
            // xiumi.contentWindow.postMessage('XIUMI:3rdEditor:Connect', xiumi_url);
        };
        document.addEventListener("mousewheel", function(event) {
            event.preventDefault();
            event.stopPropagation();
        });
        window.addEventListener('message', function(event) {
            console.log("Received message from xiumi, origin: %o %o", event.origin, xiumi_url);
            if (event.origin == xiumi_url) {
                console.log("Inserting html");
                editor.execCommand('insertHtml', event.data);
                console.log("Xiumi dialog is closing");
                dialog.close();
            }
        }, false);
    </script>
    <script>
        var xiumi = document.getElementById("xiumi");
        xiumi.onload = function(){
            console.log("postMessage");
            this.loadingXiumi = false;//由于秀米加载时间比较长，应该自定义一个loading，这里写你的自定义loading的代码
            xiumi.contentWindow.postMessage("ready", xiumi_url);
        };
        window.addEventListener(
            "message",
            function() {
            if (event.origin == xiumi_url) {
            editor.$txt.html(event.data);//这步是你拿到秀米的源码后需要手动设置到你的编辑器的源码中去
            this.showXiumi = false;
        }
        },
        false
        );
    </script>



    <script async="" src="https://ls.chnssl.com/public/static/ext/xiumi/analytics.js"></script>

</body>

</html>


