<?
namespace Core\interfaces;

interface iTemplate
{
    public function setTemplateName($templateName);
    public function setVariable($name, $value);
    public function output();
}
