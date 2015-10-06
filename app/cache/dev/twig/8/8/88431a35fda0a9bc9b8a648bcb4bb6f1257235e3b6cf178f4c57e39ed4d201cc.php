<?php

/* estarRdaBundle:Campo:new.html.twig */
class __TwigTemplate_9d96097dc9f612202c338a5bdfea95d39cd252e7cbef781c96a735ecda65914a extends Twig_Template
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
        $__internal_063c1e40ce990858dfbb194c18561b334822e89da2a0cde09eb7eb07d4fb0227 = $this->env->getExtension("native_profiler");
        $__internal_063c1e40ce990858dfbb194c18561b334822e89da2a0cde09eb7eb07d4fb0227->enter($__internal_063c1e40ce990858dfbb194c18561b334822e89da2a0cde09eb7eb07d4fb0227_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_063c1e40ce990858dfbb194c18561b334822e89da2a0cde09eb7eb07d4fb0227->leave($__internal_063c1e40ce990858dfbb194c18561b334822e89da2a0cde09eb7eb07d4fb0227_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_f4dd6d5fadfac5f2f8f862f9d94c09e12f3f826f2dc4162828b854eb65e556f1 = $this->env->getExtension("native_profiler");
        $__internal_f4dd6d5fadfac5f2f8f862f9d94c09e12f3f826f2dc4162828b854eb65e556f1->enter($__internal_f4dd6d5fadfac5f2f8f862f9d94c09e12f3f826f2dc4162828b854eb65e556f1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_f4dd6d5fadfac5f2f8f862f9d94c09e12f3f826f2dc4162828b854eb65e556f1->leave($__internal_f4dd6d5fadfac5f2f8f862f9d94c09e12f3f826f2dc4162828b854eb65e556f1_prof);

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
