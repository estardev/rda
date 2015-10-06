<?php

/* estarRdaBundle:Campo:edit.html.twig */
class __TwigTemplate_58b700b15441c1b7445e272c2a16b49d18132fcdc0140477cbc45291f1a5597b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Campo:edit.html.twig", 1);
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
        $__internal_13f4ef2fb5a040249e7f38d7a199631d7554bcc9263ce69df38368fe2536dd46 = $this->env->getExtension("native_profiler");
        $__internal_13f4ef2fb5a040249e7f38d7a199631d7554bcc9263ce69df38368fe2536dd46->enter($__internal_13f4ef2fb5a040249e7f38d7a199631d7554bcc9263ce69df38368fe2536dd46_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_13f4ef2fb5a040249e7f38d7a199631d7554bcc9263ce69df38368fe2536dd46->leave($__internal_13f4ef2fb5a040249e7f38d7a199631d7554bcc9263ce69df38368fe2536dd46_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_27247061e121cc64c23c631ff9731d739e0eb1c01999f3c8595433b914596586 = $this->env->getExtension("native_profiler");
        $__internal_27247061e121cc64c23c631ff9731d739e0eb1c01999f3c8595433b914596586->enter($__internal_27247061e121cc64c23c631ff9731d739e0eb1c01999f3c8595433b914596586_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Campo edit</h1>

    ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["edit_form"]) ? $context["edit_form"] : $this->getContext($context, "edit_form")), 'form');
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
    <li>";
        // line 14
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["delete_form"]) ? $context["delete_form"] : $this->getContext($context, "delete_form")), 'form');
        echo "</li>
</ul>
";
        
        $__internal_27247061e121cc64c23c631ff9731d739e0eb1c01999f3c8595433b914596586->leave($__internal_27247061e121cc64c23c631ff9731d739e0eb1c01999f3c8595433b914596586_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Campo:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 14,  51 => 10,  44 => 6,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body -%}*/
/*     <h1>Campo edit</h1>*/
/* */
/*     {{ form(edit_form) }}*/
/* */
/*         <ul class="record_actions">*/
/*     <li>*/
/*         <a href="{{ path('campo') }}">*/
/*             Back to the list*/
/*         </a>*/
/*     </li>*/
/*     <li>{{ form(delete_form) }}</li>*/
/* </ul>*/
/* {% endblock %}*/
/* */
