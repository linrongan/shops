<?php
if(!defined('RUOYWCOM'))
{
    exit('Access Denied');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <?php include RPC_DIR.TEMPLATEPATH.'/admin/_comm/_meta_tpl.php';?>
    <link rel="stylesheet" href="/tool/upload/upload.css">
</head>
<body>
<div class="page-container">
    <form action="<?php echo _URL_.'&_action=ActionAddCategory';?>" class="form form-horizontal" method="post" id="check-form">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span> 图片(90*90)：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div id="fields_image_upload"></div>
                <input type="hidden" name="fields_image" value="" id="fields_image">
                <div id="fields_image_show"></div>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span> 类别名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" name="category_name">
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span> 排序：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="0" placeholder="" name="ry_order">
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
<?php include RPC_DIR.TEMPLATEPATH.'/admin/_comm/_footer_tpl.php';?>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/template/source/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/template/source/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/template/source/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/tool/upload/upload.js"></script>
<script type="text/javascript">

    function article_save()
    {
        alert("刷新父级的时候会自动关闭弹层。");
        window.parent.location.reload();
    }

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $('#fields_image_upload').upload({
            auto:true,  //自动上传
            fileTypeExts:'*.jpg;*.png;*.exe',   //允许文件后缀
            multi:true, //多文件上传
            fileSizeLimit:2048, //文件最大
            showUploadedPercent:true,//是否实时显示上传的百分比
            showUploadedSize:true,  //显示上传文件的大小
            removeTimeout:10,  //超时时间
            uploader:'/tool/upload/upload.php',  //服务器地址
            onUploadSuccess:function(file,res,response){
                var data = $.parseJSON(res);
                layer.msg(data.msg, {icon: data.code==0?6:5});
                if(data.code==0)
                {
                    $("#fields_image").val(data.path);
                    var file_img = '<img width="100" onclick="product_img_romve(this)" src="'+data.path+'">';
                    $("#fields_image_show").empty();
                    $("#fields_image_show").append(file_img);
                }
            }

        });

        $("#check-form").validate({
            rules:{
                fields_image:{
                    required:true
                },
                category_name:{
                    required:true
                },
                ry_order:{
                    number:true
                }
            }
        });
    });

    <?php
    if(isset($_return))
    {
    ?>
    alert('<?php echo $_return['msg']; ?>');
    if('<?php echo $_return['code']; ?>'==0){
        window.parent.location.reload();
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }
    <?php
    }
    ?>
</script>
</body>
</html>