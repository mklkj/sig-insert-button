<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgButtonSiginsertbutton extends JPlugin
{
    function onDisplay($name)
    {
    	$date = date('Y/m');
    	$alias = 'alias';

    	$input = JFactory::getApplication()->input;
		$id = $input->getInt('id', 0);
		if($id > 0 && $input->getString('option') == 'com_content' && $input->getString('view') == 'article') {
		    $c = JTable::getInstance('content');
		    $c->load($id);
		    $date = date('Y/m', strtotime($c->publish_up));
		    $alias = $c->alias;
		}

        $doc = & JFactory::getDocument();
        $doc->addScriptDeclaration('function sampleXTDButtonClick(editor) {
			txt = prompt("Please enter path to gallery", "'.$date.'/'.$alias.'");
			if (!txt) return;
			jInsertEditorText("\n<div>{gallery}galleries/" + txt + "{gallery}</div>\n", editor);
		}');

        $button = new JObject();
		$button->modal = false;
		$button->class = 'btn';
		$button->link = '#';
		$button->text = JText::_('Insert SIG code');
		$button->name = 'plus';
		$button->onclick = 'sampleXTDButtonClick(\''.$name.'\'); return false;';

        return $button;
    }
}
