 <!--"StAuth10065: I Raval Nandish, 000231318 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else."-->
 
 <?
// $filepath = 'images/'.$file;
 if ($handle = opendir('images/')) {
   

    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
        $TPL['images'][] = array('fileName' => $file, 'fileSize' => filesize('images/'.$file), 'filedate' => date('M d,Y, g:i:s a',filemtime($file)));
		
		
    }

    closedir($handle);
}

 //print_r($TPL);
 
 switch($_REQUEST['act']):
  default:
    break;
 case 'post':
   //echo 'post works';
	
	//print_r($_FILES);
	if(empty($_FILES['userfile']['tmp_name'])):
	 $TPL['errMsg'] = "NO File";
	 $TPL['diserrMsg'] = true;
	 break;
	 endif;
	 if(ereg("\.jpg|\.gif",$_POST['filename'])==FALSE):
	 
	 endif;
	 
	 copy($_FILES['userfile']['tmp_name'],'images/'.$_FILES['userfile']['name']);
	
	break;
	
case 'sortby':
 break;
 
case 'del':
echo "delete work {$_GET['file']}";
break;



 endswitch;
 ?>
 
<html>
<head>
<title>Comp10065 - Lab 4: File Upload</title>
<style type="text/css"> 
	div#container {margin-right: auto;	margin-left: auto;	border: 1px solid #EEEEEE;
		width: 800px;	padding: 10px; background:#CC9966}
	h1 {text-align: center; color:#0CF}
	table {width: 700px; margin-bottom: 15px}
	table th {text-align: left;padding: 0px 10 0px 10px}
	table td{padding: 0px 10 0px 10px; border: 1px solid #AAAAAA}
	tr.odd {background-color: #EEEEEE}
	tr.even {background-color: #CCCCCC}
	.message {color:red}
	div#debug {border: 1px solid #BBBBBB}
</style>
<script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.js"></script>
<script type="text/javascript"> 
	function popup(img) {
		var day= new Date();
		var windowParms = 'width=400,height=400,scrollbars,resizable';
		var htmlPage = '<html><body><img src="'  + img + '"><br>' +    
						' <form><input type="button" ' + 
						' onclick="javascript:window.close();" value="Close Window"><br>\n' + 
						' </form></body></html>\n';
		var popupWindow = window.open('',day.getTime(),windowParms);
		popupWindow.document.write(htmlPage);
		popupWindow.document.close();
	}
</script> 
<script> 
$(function() {
	$("div#debug").hide();
	$("a#debugLink").click(function () {$("div#debug").toggle("slowly"); });
});
</script>
</head>
 
<body >
<div id="container">
  <h1>LAB: Picture Uploader! </h1>
       
	  <p>Click here to <a href="<?= $_SERVER['PHP_SELF']?>">refresh</a> this page.
      
      	 		  <table>
			<tr> 
			  <th>File Name (<a href="upload.php?act=sortby&col=filename">sort</a>)</th>
			  <th>Size KBytes (<a href="upload.php?act=sortby&col=size">sort</a>)</th>
			  <th>Date</th>
			  <th></th> 
			   <th></th> 
			</tr>
			<? foreach($TPL['images'] as $key => $val): ?>
            <tr>
			<td>
            <a href="<?= 'images/'.$val['fileName'] ?>"> <?= $val['fileName'] ?> </td>
			 
			<td> <?= $val['fileSize'] ?></td>
			<td><?= $val['filedate']?></td>
			<td><a href="#" onClick="popup('images/nature32.jpg')"  >View</a></td>
			<td align=center><a href="<?= $_SERVER['PHP_SELF']?>?act=del&file=<?= $val['fileName'] ?>">Delete</a></td>
			</tr>
			<? endforeach;?>		  </table>
            
                     			<p class="message">Records sorted by size</p>
              
       
	<form   action="<?= $_SERVER['PHP_SELF']?>"  method="post" enctype='multipart/form-data'>
       
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		
        <input type="hidden" name="act" value="post">
        <input  type="file" name="userfile" size="60" value="">
        <br>
        <input type="submit" value="UPLOAD FILE" name="submit">Do not upload large files!
      </form>
     <? if($TPL['diserrMsg']):?>
    <p> <?= $TPL['errMsg']?></p>     
      <? endif;?>
      <? if($dispsucessmsgs == 'true'):?>
      <p> The File <? $_POST['filename']?>has been successfully uploaded.</p>
      <? endif; ?>
      <hr>
      <p>Click <a href="#" id = "debugLink"> here </a> for debug info. Jquery show/hide effect.</p>
      <div id="debug">
          <p>This debug info is here to help you. You are only required to display the $_POST and $_FILES array</p>
          <pre > 
</pre> 
      </div>	 
</div> 
</body> </html>

