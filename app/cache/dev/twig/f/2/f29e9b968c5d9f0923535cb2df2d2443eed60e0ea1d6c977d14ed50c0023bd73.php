<?php

/* ::base.html.twig */
class __TwigTemplate_509fb093d1dea578acb11bf59584eb44538ded4f30caa7308603eec78988057f extends Twig_Template
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
        $__internal_2a310bce4f37eaee34b59c134e0da0d2e867533c2d2cb68d775e5910de7f1e1a = $this->env->getExtension("native_profiler");
        $__internal_2a310bce4f37eaee34b59c134e0da0d2e867533c2d2cb68d775e5910de7f1e1a->enter($__internal_2a310bce4f37eaee34b59c134e0da0d2e867533c2d2cb68d775e5910de7f1e1a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

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
        
        $__internal_2a310bce4f37eaee34b59c134e0da0d2e867533c2d2cb68d775e5910de7f1e1a->leave($__internal_2a310bce4f37eaee34b59c134e0da0d2e867533c2d2cb68d775e5910de7f1e1a_prof);

    }

    // line 19
    public function block_body($context, array $blocks = array())
    {
        $__internal_e3bc14415afdd695e512b9c21e95eec051a0031fdf115f2e4dfb32f69ba0d4e4 = $this->env->getExtension("native_profiler");
        $__internal_e3bc14415afdd695e512b9c21e95eec051a0031fdf115f2e4dfb32f69ba0d4e4->enter($__internal_e3bc14415afdd695e512b9c21e95eec051a0031fdf115f2e4dfb32f69ba0d4e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_e3bc14415afdd695e512b9c21e95eec051a0031fdf115f2e4dfb32f69ba0d4e4->leave($__internal_e3bc14415afdd695e512b9c21e95eec051a0031fdf115f2e4dfb32f69ba0d4e4_prof);

    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_3166a333b66886859420f39a2ed797ac43516d92c689b919f6727d19b9dd18e5 = $this->env->getExtension("native_profiler");
        $__internal_3166a333b66886859420f39a2ed797ac43516d92c689b919f6727d19b9dd18e5->enter($__internal_3166a333b66886859420f39a2ed797ac43516d92c689b919f6727d19b9dd18e5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_3166a333b66886859420f39a2ed797ac43516d92c689b919f6727d19b9dd18e5->leave($__internal_3166a333b66886859420f39a2ed797ac43516d92c689b919f6727d19b9dd18e5_prof);

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
