<?php

/* ::base.html.twig */
class __TwigTemplate_90929e32cee02829fef8c20c5a271bd13bcaef65f7b96e2f6e2cb14839aeac0f extends Twig_Template
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
        $__internal_3ec449a96a641ce4541df886b03f7aa5d07de004a6e80075912340d44698239d = $this->env->getExtension("native_profiler");
        $__internal_3ec449a96a641ce4541df886b03f7aa5d07de004a6e80075912340d44698239d->enter($__internal_3ec449a96a641ce4541df886b03f7aa5d07de004a6e80075912340d44698239d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

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
        
        $__internal_3ec449a96a641ce4541df886b03f7aa5d07de004a6e80075912340d44698239d->leave($__internal_3ec449a96a641ce4541df886b03f7aa5d07de004a6e80075912340d44698239d_prof);

    }

    // line 19
    public function block_body($context, array $blocks = array())
    {
        $__internal_5d765d3a67dad3d370c1ae8df5c43e4077ae225dd9511f3419286df4077b2155 = $this->env->getExtension("native_profiler");
        $__internal_5d765d3a67dad3d370c1ae8df5c43e4077ae225dd9511f3419286df4077b2155->enter($__internal_5d765d3a67dad3d370c1ae8df5c43e4077ae225dd9511f3419286df4077b2155_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_5d765d3a67dad3d370c1ae8df5c43e4077ae225dd9511f3419286df4077b2155->leave($__internal_5d765d3a67dad3d370c1ae8df5c43e4077ae225dd9511f3419286df4077b2155_prof);

    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_7ea681e7499d826a564de3f08ef8dd2edb18f4e2e653c5ba6d8ad467bde096a8 = $this->env->getExtension("native_profiler");
        $__internal_7ea681e7499d826a564de3f08ef8dd2edb18f4e2e653c5ba6d8ad467bde096a8->enter($__internal_7ea681e7499d826a564de3f08ef8dd2edb18f4e2e653c5ba6d8ad467bde096a8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_7ea681e7499d826a564de3f08ef8dd2edb18f4e2e653c5ba6d8ad467bde096a8->leave($__internal_7ea681e7499d826a564de3f08ef8dd2edb18f4e2e653c5ba6d8ad467bde096a8_prof);

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
