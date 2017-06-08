<?
namespace Core;

class FTemplate implements Interfaces\iTemplate
{
    protected $name;
    protected $vars = [];

    // устанавливает имя файла шаблона, который будет использоваться
    public function setTemplateName($templateName)
    {
        $this->name = $templateName;
    }

    // метод задает переменные, которые доступны в шаблоне
    public function setVariable($name, $value)
    {
        $this->vars[$name] = $value;
    }

    // выводит шаблон
    public function output($return = false)
    {
        ob_start();

        extract($this->vars);

        include($_SERVER['DOCUMENT_ROOT'] .'/application/templates/'.$this->name.'.php');

        $content = ob_get_clean();

        if($return){
            return $content;
        }else{
            echo $content;
        }

    }


}