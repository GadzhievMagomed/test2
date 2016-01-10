<?php

/* layout.html */
class __TwigTemplate_c11c9e50046390cc9e512da8cc85985c42920d30ac5ec2161ece4a01c9efd915 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Test</title>
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "url", array(0 => ""), "method"), "html", null, true);
        echo "\">
</head>
<body>
";
        // line 9
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "

</body>
</html>";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "22
";
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 10,  42 => 9,  35 => 12,  33 => 9,  27 => 6,  20 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* <head>*/
/*     <meta charset="UTF-8">*/
/*     <title>Test</title>*/
/*     <link rel="stylesheet" href="{{ app.url('') }}">*/
/* </head>*/
/* <body>*/
/* {% block content %}*/
/* 22*/
/* {% endblock %}*/
/* */
/* */
/* </body>*/
/* </html>*/
