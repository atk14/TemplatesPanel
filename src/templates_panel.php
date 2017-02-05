<?php
/**
 * Displays nested list of all rendered templates
 *
 * Acts like a Tracy panel.
 */
class TemplatesPanel implements Tracy\IBarPanel {
	function getTab(){
		return "Templates";
	}

	function getPanel(){
		$items = Atk14Smarty::$ATK14_RENDERED_TEMPLATES;
		return $this->_renderList($items);
	}

	function _renderList($items){
		$root = ATK14_DOCUMENT_ROOT;
		$out = array();

		$str = "";
		$prev_str = "";
		$cnt = 0;
		foreach($items as $item){
			$template = Files::_NormalizeFilename($item["template"]);
			if(substr($template,0,strlen($root))==$root){
				$template = substr($template,strlen($root));
			}

			$str = $template.$this->_renderList($item["children"]);

			if($prev_str && $str!=$prev_str){
				$out[] = $cnt>1 ? "<strong>$cnt&times;</strong> $prev_str" : $prev_str;
				$cnt = 0;
			}

			$prev_str = $str;
			$cnt++;
		}
		if($prev_str){
			$out[] = $cnt>1 ? "<strong>$cnt&times;</strong> $prev_str" : $prev_str;
		}

		if($out){
			return '<ul style="padding-left: 1em;"><li>'.join('</li><li>',$out).'</li></ul>';
		}
		return '';
	}
}
