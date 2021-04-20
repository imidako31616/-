<?php
 $disp_num = $_POST['disp_num'];
 $pre_num = $_POST['pre_num'];
 $input_num = $_POST['input_num'];
 $ope = $_POST['ope'];
 $button = $_POST['button'];
 $pre_button = $_POST['pre_button'];
 
 if(isNumBtn($button) || empty($button)) {
 	if(isOpeBtn($pre_button)) {
 		$pre_num = $disp_num;
 		if (preg_match('/\./',$button)){
 			$disp_num = '0.';
 		}else{
 			$disp_num = $button;
 			}
 	}else{
 		$disp_num = $disp_num . $button;
 		}
 		
 		$input_num = $disp_num;
 	}else{
    switch ($button) {
        case 'C':
            $disp_num = '';
            break;
        case 'AC':
            $disp_num = '';
            $pre_num = '';
            $input_num = '';
            break;
        case '+/-':
            $disp_num = -$disp_num;
            break;
        case '％':
            $disp_num = $disp_num / 100;
            break;
        default:
            if (!empty($pre_num) && (preg_match('/＝/', $button) || (isOpeBtn($button) && isNumBtn($pre_button)))) {
                switch ($ope) {
                    case '＋':
                        $disp_num = $pre_num  + $disp_num;
                        break;
                    case '-':
                        $disp_num = $pre_num - $disp_num;
                        break;
                    case '*':
                        $disp_num = $pre_num * $disp_num;
                        break;
                    case '/':
                        $disp_num = $pre_num / $disp_num;
                        break;
                    default:
                        break;
 	 		 }
 		}
 		$pre_num = $input_num;
 		$ope = $button == '=' ? $ope : $button;
 		break;
 	}
 	
 	}
 	
 	
 	$pre_button = $button;
 	
function convertDispNum($num){
 		preg_match('/(-?)(\d+)(\.?\d*)/' , $num, $matches);
 		
 		return $matches[1] . number_format($matches[2]) . $matches[3];
 	}
function isOpeBtn($btn){
 		return preg_match('/(+|-|*|/)/', $btn);
 	}
 	
function isNumBtn($btn){
 		return preg_match('/(\d|\.)/' , $btn);
 	}
 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
 	<title>電卓</title>
 	<link rel="stylesheet" type="text/css" href="dentaku.css">
 </head>
 <body>
 	<h2>電卓</h2>
 	<p class = "answer"><?php echo convertDispNum($disp_num); ?></p>
    <div class = "sousa">
    <p>～操作方法～</p>
    <p>①一つ目の数字を入れる</p>
    <p>②＋、－、×、÷のどれかを押す</p>
    <p>③<span>(重要!)Cを押す</span></p>
    <p>④二つ目の数字を入れる</p>
    <p>⑤＝を押す</p>
    <p>(注意)三つ以上の計算は出来ません</p>
    </div>
    
    <div class= "but" >
    <form action="?" method="post">
        <input type="hidden" name="disp_num" value="<?php echo $disp_num; ?>" />
        <input type="hidden" name="pre_num" value="<?php echo $pre_num; ?>" />
        <input type="hidden" name="input_num" value="<?php echo $input_num; ?>" />
        <input type="hidden" name="pre_button" value="<?php echo $pre_button; ?>" />
        <input type="hidden" name="ope" value="<?php echo $ope; ?>" />
        <table>
            <tr>
                <td><button type="submit" name="button" value="C">C</button></td>
                <td><button type="submit" name="button" value="AC">AC</button></td>
                <td><button type="submit" name="button" value="+/-">+/-</button></td>
                <td><button type="submit" name="button" value="÷">÷</button></button></td>
            </tr>
            <tr>
                <td><button type="submit" name="button" value="7">7</button></td>
                <td><button type="submit" name="button" value="8">8</button></td>
                <td><button type="submit" name="button" value="9">9</button></td>
                 <td><button type="submit" name="button" value="*">×</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="button" value="4">4</button></td>
                <td><button type="submit" name="button" value="5">5</button></td>
                <td><button type="submit" name="button" value="6">6</button></td>
                <td><button type="submit" name="button" value="-">－</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="button" value="1">1</button></td>
                <td><button type="submit" name="button" value="2">2</button></td>
                <td><button type="submit" name="button" value="3">3</button></td>
                <td><button type="submit" name="button" value="＋">＋</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="button" value="0">0</button></td>
                <td><button type="submit" name="button" value="％">％</button></td>
                <td><button type="submit" name="button" value=".">.</button></td>
                <td><button type="submit" name="button" value="＝">＝</button></td>
            </tr>
    </div>
   
    </form>
</body>
</html>