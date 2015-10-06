<?php

/* ::base.html.twig */
class __TwigTemplate_a5665ea27375338390a743d6c2286f8b663b334074dedcac7d814a0ffaca36f2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_47705807a5bc26b20df4c2989eef7611dceeb385ff4baa32a4406c51a087b067 = $this->env->getExtension("native_profiler");
        $__internal_47705807a5bc26b20df4c2989eef7611dceeb385ff4baa32a4406c51a087b067->enter($__internal_47705807a5bc26b20df4c2989eef7611dceeb385ff4baa32a4406c51a087b067_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>

\t\t<title>RDA</title>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t\t<!-- Bootstrap -->
\t\t<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"screen\">

\t\t<!-- HTML5 Shim and Respond.js add IE8 support of HTML5 elements and media queries -->
\t\t";
        // line 11
        $this->loadTemplate("BraincraftedBootstrapBundle::ie8-support.html.twig", "::base.html.twig", 11)->display($context);
        // line 12
        echo "
\t</head>
\t
    <body>
\t\t<div class=\"container\">
\t\t
\t\t
\t\t\t";
        // line 19
        $this->displayBlock('body', $context, $blocks);
        // line 20
        echo "\t\t\t";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 21
        echo "\t\t</div>
    </body>
</html>
";
        
        $__internal_47705807a5bc26b20df4c2989eef7611dceeb385ff4baa32a4406c51a087b067->leave($__internal_47705807a5bc26b20df4c2989eef7611dceeb385ff4baa32a4406c51a087b067_prof);

    }

    // line 19
    public function block_body($context, array $blocks = array())
    {
        $__internal_77f6ba2b1765699a3ec60d91ffafe91613c519247d9ceb681d6654233a5ad6bf = $this->env->getExtension("native_profiler");
        $__internal_77f6ba2b1765699a3ec60d91ffafe91613c519247d9ceb681d6654233a5ad6bf->enter($__internal_77f6ba2b1765699a3ec60d91ffafe91613c519247d9ceb681d6654233a5ad6bf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_77f6ba2b1765699a3ec60d91ffafe91613c519247d9ceb681d6654233a5ad6bf->leave($__internal_77f6ba2b1765699a3ec60d91ffafe91613c519247d9ceb681d6654233a5ad6bf_prof);

    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_c117f8408eadc1bdec2da81a1c3ac76b6e3440ef2499b10087f3f2ec40def471 = $this->env->getExtension("native_profiler");
        $__internal_c117f8408eadc1bdec2da81a1c3ac76b6e3440ef2499b10087f3f2ec40def471->enter($__internal_c117f8408eadc1bdec2da81a1c3ac76b6e3440ef2499b10087f3f2ec40def471_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_c117f8408eadc1bdec2da81a1c3ac76b6e3440ef2499b10087f3f2ec40def471->leave($__internal_c117f8408eadc1bdec2da81a1c3ac76b6e3440ef2499b10087f3f2ec40def471_prof);

    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 20,  65 => 19,  55 => 21,  52 => 20,  50 => 19,  41 => 12,  39 => 11,  33 => 8,  24 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/* */
/* 		<title>RDA</title>*/
/* 		<meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/* 		<!-- Bootstrap -->*/
/* 		<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" media="screen">*/
/* */
/* 		<!-- HTML5 Shim and Respond.js add IE8 support of HTML5 elements and media queries -->*/
/* 		{% include 'BraincraftedBootstrapBundle::ie8-support.html.twig' %}*/
/* */
/* 	</head>*/
/* 	*/
/*     <body>*/
/* 		<div class="container">*/
/* 		*/
/* 		*/
/* 			{% block body %}{% endblock %}*/
/* 			{% block javascripts %}{% endblock %}*/
/* 		</div>*/
/*     </body>*/
/* </html>*/
/* */
