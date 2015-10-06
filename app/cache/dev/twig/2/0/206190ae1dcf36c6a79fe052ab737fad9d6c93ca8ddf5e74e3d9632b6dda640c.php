<?php

/* estarRdaBundle:Categoria:new.html.twig */
class __TwigTemplate_5067b478ad1149a59074508a252fb2bfcf7662e18a1f0c11f48e6a7e2662d48f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Categoria:new.html.twig", 1);
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
        $__internal_c5c76f1cde7c6f402ca4b6b40b06734c6edd51dfa5d9aa332070920d8bd743a7 = $this->env->getExtension("native_profiler");
        $__internal_c5c76f1cde7c6f402ca4b6b40b06734c6edd51dfa5d9aa332070920d8bd743a7->enter($__internal_c5c76f1cde7c6f402ca4b6b40b06734c6edd51dfa5d9aa332070920d8bd743a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Categoria:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c5c76f1cde7c6f402ca4b6b40b06734c6edd51dfa5d9aa332070920d8bd743a7->leave($__internal_c5c76f1cde7c6f402ca4b6b40b06734c6edd51dfa5d9aa332070920d8bd743a7_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_2a8bb0b617f12f829922df2ae27d56c7b75de7625ebdcf8c668a1b3d897e6701 = $this->env->getExtension("native_profiler");
        $__internal_2a8bb0b617f12f829922df2ae27d56c7b75de7625ebdcf8c668a1b3d897e6701->enter($__internal_2a8bb0b617f12f829922df2ae27d56c7b75de7625ebdcf8c668a1b3d897e6701_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Categoria creation</h1>

    ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "

        <ul class=\"record_actions\">
    <li>
        <a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("categoria");
        echo "\">
            Back to the list
        </a>
    </li>
</ul>
";
        
        $__internal_2a8bb0b617f12f829922df2ae27d56c7b75de7625ebdcf8c668a1b3d897e6701->leave($__internal_2a8bb0b617f12f829922df2ae27d56c7b75de7625ebdcf8c668a1b3d897e6701_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Categoria:new.html.twig";
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
/*     <h1>Categoria creation</h1>*/
/* */
/*     {{ form(form) }}*/
/* */
/*         <ul class="record_actions">*/
/*     <li>*/
/*         <a href="{{ path('categoria') }}">*/
/*             Back to the list*/
/*         </a>*/
/*     </li>*/
/* </ul>*/
/* {% endblock %}*/
/* */
