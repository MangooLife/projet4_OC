<?php 
	namespace app\widget;
	
	class Form{

		public $ending = 'br';

		private function surround($html)
		{
			return "{$html}<{$this->ending}/>";
		}

		public function input($txt,$type,$txtOption,$placeHolder=null)
		{
			return $this->surround('<label for="'.$txtOption.'">'.$txt.'<br/><input type="'.$type.'" id="'.$txtOption.'" name="'.$txtOption.'" placeholder="'.$placeHolder.'" required/></label>');
		}

		public function submit($txt)
		{
			return $this->surround('<input type="submit" value="'.$txt.'"/>');
		}
	}