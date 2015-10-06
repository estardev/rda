<?php

/* estarRdaBundle:Campo:new.html.twig */
class __TwigTemplate_204d666b298fa6b3a11d5bd8d3675e7ed03374455c81974c23969165b48f0b52 extends Twig_Template
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
        $__internal_096cd8727434c97db1ebe244f860fae171681a1b657b342408045ba5c8e03010 = $this->env->getExtension("native_profiler");
        $__internal_096cd8727434c97db1ebe244f860fae171681a1b657b342408045ba5c8e03010->enter($__internal_096cd8727434c97db1ebe244f860fae171681a1b657b342408045ba5c8e03010_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_096cd8727434c97db1ebe244f860fae171681a1b657b342408045ba5c8e03010->leave($__internal_096cd8727434c97db1ebe244f860fae171681a1b657b342408045ba5c8e03010_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_332cb2f731aa44e9b4d34fb3f7902c42aa799981a39e758a4d3e0e78ea84147b = $this->env->getExtension("native_profiler");
        $__internal_332cb2f731aa44e9b4d34fb3f7902c42aa799981a39e758a4d3e0e78ea84147b->enter($__internal_332cb2f731aa44e9b4d34fb3f7902c42aa799981a39e758a4d3e0e78ea84147b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_332cb2f731aa44e9b4d34fb3f7902c42aa799981a39e758a4d3e0e78ea84147b->leave($__internal_332cb2f731aa44e9b4d34fb3f7902c42aa799981a39e758a4d3e0e78ea84147b_prof);

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
