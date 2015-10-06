<?php

/* estarRdaBundle:Campo:new.html.twig */
class __TwigTemplate_44e5590ff6223be43be74fa4b00992202888d2c5b308d94e9a1876c2e59f18ff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Campo:new.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_632f96f24fb3e1b78b400e2766b7afd6ede3944309376aaeabe3d74d39ad4e13 = $this->env->getExtension("native_profiler");
        $__internal_632f96f24fb3e1b78b400e2766b7afd6ede3944309376aaeabe3d74d39ad4e13->enter($__internal_632f96f24fb3e1b78b400e2766b7afd6ede3944309376aaeabe3d74d39ad4e13_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_632f96f24fb3e1b78b400e2766b7afd6ede3944309376aaeabe3d74d39ad4e13->leave($__internal_632f96f24fb3e1b78b400e2766b7afd6ede3944309376aaeabe3d74d39ad4e13_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_806da00196883d91264728d4d453f43aaa36cb928d38b181fb0770c6968cbe96 = $this->env->getExtension("native_profiler");
        $__internal_806da00196883d91264728d4d453f43aaa36cb928d38b181fb0770c6968cbe96->enter($__internal_806da00196883d91264728d4d453f43aaa36cb928d38b181fb0770c6968cbe96_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Campo creation</h1>

    ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "

        <ul class=\"record_actions\">
    <li>
        <a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("campo");
        echo "\">
            Back to the list
        </a>
    </li>
</ul>
";
        
        $__internal_806da00196883d91264728d4d453f43aaa36cb928d38b181fb0770c6968cbe96->leave($__internal_806da00196883d91264728d4d453f43aaa36cb928d38b181fb0770c6968cbe96_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Campo:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 10,  44 => 6,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body -%}*/
/*     <h1>Campo creation</h1>*/
/* */
/*     {{ form(form) }}*/
/* */
/*         <ul class="record_actions">*/
/*     <li>*/
/*         <a href="{{ path('campo') }}">*/
/*             Back to the list*/
/*         </a>*/
/*     </li>*/
/* </ul>*/
/* {% endblock %}*/
/* */
