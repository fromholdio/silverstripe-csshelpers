<?php

namespace Fromholdio\CSSHelpers\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\CMS\Model\SiteTreeExtension;
use SilverStripe\Control\Controller;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Security\Security;

class CSSHelpersExtension extends SiteTreeExtension
{
    public function BodyCSSClass()
    {
        $ancestors = $this->getOwner()->getAncestors(true);
        $sections = array();
        $fullSection = 'Body';
        foreach($ancestors->reverse() as $ancestor) {
            $sections[] = $fullSection . '--'. $ancestor->URLSegment;
            $fullSection .= '--' . $ancestor->URLSegment;
        }
        $types = '';
        foreach(array_reverse(ClassInfo::ancestry($this->getOwner()->ClassName)) as $className) {
            if ($className == SiteTree::class) break;
            $types .= ' class-' . strtolower(ClassInfo::shortName($className));

        }
        $classString = '';
        foreach($sections as $section){
            $classString .= $section . ' ';
        }
        $classString .= $types;

        $controller = Controller::curr();
        $classString .= ' action-' . $controller->getAction();

        $loggedString = ($member = Security::getCurrentUser())
            ? 'logged-in'
            : 'logged-out';

        $classString .= ' ' . $loggedString;

        return $classString;
    }

    public function BodyCSSID()
    {
        $ancestors = $this->getOwner()->getAncestors(true);
        $idString = 'page';
        foreach($ancestors->reverse() as $ancestor) {
            $idString .= '-' . $ancestor->URLSegment;
        }
        return $idString;
    }
}
