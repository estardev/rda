<?php

/* estarRdaBundle:Campo:show.html.twig */
class __TwigTemplate_2a41ecc3e3da7822e9d98be4baa0d9c9310d688cc7f1fdd260c6f1a5dc399e18 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Campo:show.html.twig", 1);
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
        $__internal_0f71eb547d7fd79cf8ede9a58f724ebc9ca6c42eca948279c979570f4a591b46 = $this->env->getExtension("native_profiler");
        $__internal_0f71eb547d7fd79cf8ede9a58f724ebc9ca6c42eca948279c979570f4a591b46->enter($__internal_0f71eb547d7fd79cf8ede9a58f724ebc9ca6c42eca948279c979570f4a591b46_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0f71eb547d7fd79cf8ede9a58f724ebc9ca6c42eca948279c979570f4a591b46->leave($__internal_0f71eb547d7fd79cf8ede9a58f724ebc9ca6c42eca948279c979570f4a591b46_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_bc48a85b33dacf0c902d83848a72f123799baadf44dcf17b5563ae4277b40d44 = $this->env->getExtension("native_profiler");
        $__internal_bc48a85b33dacf0c902d83848a72f123799baadf44dcf17b5563ae4277b40d44->enter($__internal_bc48a85b33dacf0c902d83848a72f123799baadf44dcf17b5563ae4277b40d44_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Campo</h1>

    <table class=\"record_properties\">
        <tbody>
            <tr>
                <th>Nome</th>
                <td>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "nome", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Descrizione</th>
                <td>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "descrizione", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "tipo", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Obbligatorioinserzione</th>
                <td>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "obbligatorioinserzione", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Obbligatoriovalidazione</th>
                <td>";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "obbligatoriovalidazione", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Ordinamento</th>
                <td>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "ordinamento", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Fieldset</th>
                <td>";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "fieldset", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Ordinamentofieldset</th>
                <td>";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "ordinamentofieldset", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Id</th>
                <td>";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "id", array()), "html", null, true);
        echo "</td>
            </tr>
        </tbody>
    </table>

        <ul class=\"record_actions\">
    <li>
        <a href=\"";
        // line 49
        echo $this->env->getExtension('routing')->getPath("campo");
        echo "\">
            Back to the list
        </a>
    </li>
    <li>
        <a href=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("campo_edit", array("id" => $this->getAttribute((isset($context["entity"]) ? $context["entity"] : $this->getContext($context, "entity")), "id", array()))), "html", null, true);
        echo "\">
            Edit
        </a>
    </li>
    <li>";
        // line 58
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["delete_form"]) ? $context["delete_form"] : $this->getContext($context, "delete_form")), 'form');
        echo "</li>
</ul>
";
        
        $__internal_bc48a85b33dacf0c902d83848a72f123799baadf44dcf17b5563ae4277b40d44->leave($__internal_bc48a85b33dacf0c902d83848a72f123799baadf44dcf17b5563ae4277b40d44_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Campo:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 58,  122 => 54,  114 => 49,  104 => 42,  97 => 38,  90 => 34,  83 => 30,  76 => 26,  69 => 22,  62 => 18,  55 => 14,  48 => 10,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body -%}*/
/*     <h1>Campo</h1>*/
/* */
/*     <table class="record_properties">*/
/*         <tbody>*/
/*             <tr>*/
/*                 <th>Nome</th>*/
/*                 <td>{{ entity.nome }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Descrizione</th>*/
/*                 <td>{{ entity.descrizione }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Tipo</th>*/
/*                 <td>{{ entity.tipo }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Obbligatorioinserzione</th>*/
/*                 <td>{{ entity.obbligatorioinserzione }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Obbligatoriovalidazione</th>*/
/*                 <td>{{ entity.obbligatoriovalidazione }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Ordinamento</th>*/
/*                 <td>{{ entity.ordinamento }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Fieldset</th>*/
/*                 <td>{{ entity.fieldset }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Ordinamentofieldset</th>*/
/*                 <td>{{ entity.ordinamentofieldset }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Id</th>*/
/*                 <td>{{ entity.id }}</td>*/
/*             </tr>*/
/*         </tbody>*/
/*     </table>*/
/* */
/*         <ul class="record_actions">*/
/*     <li>*/
/*         <a href="{{ path('campo') }}">*/
/*             Back to the list*/
/*         </a>*/
/*     </li>*/
/*     <li>*/
/*         <a href="{{ path('campo_edit', { 'id': entity.id }) }}">*/
/*             Edit*/
/*         </a>*/
/*     </li>*/
/*     <li>{{ form(delete_form) }}</li>*/
/* </ul>*/
/* {% endblock %}*/
/* */
