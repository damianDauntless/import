<?php

namespace craft\plugins\import\web\twig\variables;

use Craft;

/**
 * Import Variable.
 *
 * Injects logics into the templates
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Bob Olde Hampsink
 * @license   http://buildwithcraft.com/license Craft License Agreement
 *
 * @link      http://github.com/boboldehampsink
 */
class Import
{
    /**
     * Get element types.
     *
     * @return array
     */
    public function getElementTypes()
    {
        $elementTypes = [];
        foreach (Craft::$app->elements->getAllElementTypes() as $elementType) {
            if ($this->getGroups($elementType)) {
                $elementTypes[] = $elementType;
            }
        }

        return $elementTypes;
    }

    /**
     * Get groups for service.
     *
     * @param string $elementType
     *
     * @return array|bool
     */
    public function getGroups($elementType)
    {
        // Check if elementtype can be imported
        if ($service = Craft::$app->plugins->getPlugin('import')->import->getService($elementType)) {

            // Return "groups" (section, groups, etc.)
            return $service->getGroups();
        }

        return false;
    }

    /**
     * Get template for service.
     *
     * @param string $elementType
     *
     * @return array|bool
     */
    public function getTemplate($elementType)
    {
        // Check if elementtype can be imported
        if ($service = Craft::$app->plugins->getPlugin('import')->import->getService($elementType)) {

            // Return template
            return $service->getTemplate();
        }

        return false;
    }

    /**
     * Show history overview.
     *
     * @return array
     */
    public function history()
    {
        // Return all history
        return Craft::$app->plugins->getPlugin('import')->history->show();
    }

    /**
     * Show history detail.
     *
     * @param int $history
     *
     * @return array
     */
    public function log($history)
    {
        // Return the log from a certain history
        return Craft::$app->plugins->getPlugin('import')->history->showLog($history);
    }
}
