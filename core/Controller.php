<?
namespace Core;



abstract class Controller
{
    protected $template;

    public function __construct()
    {
        $this->template = new FTemplate();
    }

    abstract function index();
}