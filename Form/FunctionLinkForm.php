<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/
/*************************************************************************************/

namespace Team\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Team\Model\PersonFunctionQuery;
use Team\Team;
use Thelia\Form\BaseForm;

/**
 * Class FunctionLinkForm
 * @package Team\Form
 */
class FunctionLinkForm extends BaseForm
{

    /**
     * @inheritDoc
     */
    protected function buildForm()
    {
        $this->formBuilder
            ->add("function", 'choice', array(
                "choices" => $this->getFunction(),
                "label" => $this->translator->trans("Function Id", [], Team::DOMAIN_NAME),
                "label_attr" => ["for" => "attr-function-id"],
                "required" => true,
                "attr" => array()
            ))
            ->add('person', 'integer', array(
                "label" => $this->translator->trans("Person Id", [], Team::DOMAIN_NAME),
                "label_attr" => ["for" => "attr-person-id"],
                "required" => true,
                "constraints" => array(new NotBlank(),),
                "attr" => array()
            ));
    }

    public function getName()
    {
        return "person_function_link_create";
    }

    protected function getFunction(){
        $functions = PersonFunctionQuery::create()->find();
        $retour = [];
        foreach($functions as $function){
            $retour[$function->getId()] = $function->getLabel();
        }
        return $retour;
    }
}