/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
let baseUrl = "public/ckeditor/";
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
    config.language = 'zh-cn';
	// config.uiColor = '#AADC6E';
    //编辑器样式
    config.skin = "moono-lisa";
    //config.filebrowserUploadUrl = baseUrl + 'static/upload/';
    // config.uiColor = '#AADC6E';
    //工具栏是否可以被收缩
    config.toolbarCanCollapse = true;

    config.toolbar = [
        ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'],
        //剪切    复制     粘贴      粘贴纯文本
        ['Cut', 'Copy', 'Paste', 'PasteText'],
        // 数字列表          实体列表            减小缩进     增大缩进          查找     替换
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Find', 'Replace'],
        //超链接  取消超链接 锚点
        ['Link', 'Unlink', 'Anchor'],
        //图片     表格       水平线             表情          特殊字符           分页符
        ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', '-', 'PageBreak'], '/',
        //加粗     斜体，     下划线      穿过线      下标字        上标字
        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
        //左对 齐             居中对齐          右对齐          两端对齐
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        // 样式       格式      字体    字体大小
        ['Styles', 'Format', 'Font', 'FontSize'],
        //文本颜色     背景颜色
        ['TextColor', 'BGColor'],
        //全屏           显示区块
        ['Maximize', 'ShowBlocks', '-']
    ];

    // config.toolbar_Full = [
    //     ['Source','-','Save','NewPage','Preview','-','Templates'],
    //     ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    //     ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    //     ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
    //     '/',
    //     ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    //     ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    //     ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    //     ['Link','Unlink','Anchor'],
    //     ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    //     '/',
    //     ['Styles','Format','Font','FontSize'],
    //     ['TextColor','BGColor']
    // ];

    //字体编辑时的字符集 可以添加常用的中文字符：宋体、楷体、黑体等 plugins/font/plugin.js
    //config.font_names = 'Arial;Times New Roman;Verdana';

    // “拖拽以改变尺寸”功能 plugins/resize/plugin.js
    config.resize_enabled = true;
    //图片预览文字
    config.image_previewText = ' ';
    //是否强制复制来的内容去除格式 plugins/pastetext/plugin.js
    config.forcePasteAsPlainText = true;

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    //移除toolbar上的某个按钮
    //config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    //移除窗口上的选项
    config.removeDialogTabs = 'image:advanced;link:advanced';

    //自定义配置
    //config.配置项 = 值
    //config.width = 100%;
    config.height = 400;
    //config.uiColor = "#cc0041";

    //文件的上传管理：加载CKfinder  注意文件路径为网站根目录 使用时，注意ckfinder文件安装路径
    config.filebrowserBrowseUrl = baseUrl + 'ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = baseUrl + 'ckfinder/ckfinder.html?Type=Images';
    config.filebrowserFlashBrowseUrl = baseUrl + 'ckfinder/ckfinder.html?Type=Flash';
    config.filebrowserUploadUrl = baseUrl + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = baseUrl + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = baseUrl + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
