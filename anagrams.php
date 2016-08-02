<?
	function freq($word) {
		$c=[];
		$a=str_split($word);
		foreach($a as $v)	{
			if(array_key_exists($v,$c)) {
				$c[$v]++;
			} else {
				$c[$v]=1;
			}
		}
		return $c;
	}

	function isAnagram($w1,$w2) {
		$c1=freq($w1);
		$c2=freq($w2);
		foreach($c2 as $k => $v) {
			if(!array_key_exists($k,$c1) || $c1[$k]<$v) {
				return false;
			}
		}
		return true;
	}	
	
	function getAnagrams($word,$dict) {
		$a=[];
		foreach($dict as $w) {
			if(isAnagram($word,$w)) {
				$a[]=$w;
			}
		}
		return $a;
	}

	function filterWords($dict,$min,$max) {
		$a=[];
		foreach($dict as $w) {
			$len=strlen($w);
			if($len>=$min && $len<=$max) {
				$a[]=$w;
			}
		}
		return $a;
	}

	$dict=file('wordlist.txt',FILE_IGNORE_NEW_LINES);
	
	$dict=filterWords($dict,3,8);
	
	$chosen=filterWords($dict,6,8);
	
	$word=$chosen[array_rand($chosen)];

	$anagrams=getAnagrams($word,$dict);
	
	$result=array('word'=>$word,'anagrams'=>$anagrams);
	
	echo json_encode($result);
	
?>
