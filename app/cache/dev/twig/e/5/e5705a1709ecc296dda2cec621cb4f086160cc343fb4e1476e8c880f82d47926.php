<?php

/* estarRdaBundle:Campo:index.html.twig */
class __TwigTemplate_517101d7f7bf223230970763f11f3803ce5bab2c3b49484dbd7fe2bcb9512529 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Campo:index.html.twig", 1);
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
        $__internal_e1497b1fb7abe3ecf5755b82176a49aebb9eafa5aac625f8ac22cf462622bb70 = $this->env->getExtension("native_profiler");
        $__internal_e1497b1fb7abe3ecf5755b82176a49aebb9eafa5aac625f8ac22cf462622bb70->enter($__internal_e1497b1fb7abe3ecf5755b82176a49aebb9eafa5aac625f8ac22cf462622bb70_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e1497b1fb7abe3ecf5755b82176a49aebb9eafa5aac625f8ac22cf462622bb70->leave($__internal_e1497b1fb7abe3ecf5755b82176a49aebb9eafa5aac625f8ac22cf462622bb70_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_402831ea2e072b534b7059d553d2b023915a4614c519447e962eb79f5e7f5945 = $this->env->getExtension("native_profiler");
        $__internal_402831ea2e072b534b7059d553d2b023915a4614c519447e962eb79f5e7f5945->enter($__internal_402831ea2e072b534b7059d553d2b023915a4614c519447e962eb79f5e7f5945_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Campo list</h1>

    <table class=\"records_list\">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Tipo</th>
                <th>Obbligatorioinserzione</th>
                <th>Obbligatoriovalidazione</th>
                <th>Ordinamento</th>
                <th>Fieldset</th>
                <th>Ordinamentofieldset</th>
                <th>Id</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["entities"]) ? $context["entities"] : $this->getContext($context, "entities")));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 23
            echo "            <tr>
                <td><a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("campo_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "nome", array()), "html", null, true);
            echo "</a></td>
                <td>";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "descrizione", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "tipo", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "obbligatorioinserzione", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "obbligatoriovalidazione", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "ordinamento", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "fieldset", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "ordinamentofieldset", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
            echo "</td>
                <td>
                <ul>
                    <li>
                        <a href=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("campo_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">show</a>
                    </li>
                    <li>
                        <a href=\"";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("campo_edit", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">edit</a>
                    </li>
                </ul>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "        </tbody>
    </table>

        <ul>
        <li>
            <a href=\"";
        // line 50
        echo $this->env->getExtension('routing')->getPath("campo_new");
        echo "\">
                Create a new entry
            </a>
        </li>
    </ul>
    ";
        
        $__internal_402831ea2e072b534b7059d553d2b023915a4614c519447e962eb79f5e7f5945->leave($__internal_402831ea2e072b534b7059d553d2b023915a4614c519447e962eb79f5e7f5945_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Campo:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 50,  126 => 45,  114 => 39,  108 => 36,  101 => 32,  97 => 31,  93 => 30,  89 => 29,  85 => 28,  81 => 27,  77 => 26,  73 => 25,  67 => 24,  64 => 23,  60 => 22,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body -%}*/
/*     <h1>Campo list</h1>*/
/* */
/*     <table class="records_list">*/
/*         <thead>*/
/*             <tr>*/
/*                 <th>Nome</th>*/
/*                 <th>Descrizione</th>*/
/*                 <th>Tipo</th>*/
/*                 <th>Obbligatorioinserzione</th>*/
/*                 <th>Obbligatoriovalidazione</th>*/
/*                 <th>Ordinamento</th>*/
/*                 <th>Fieldset</th>*/
/*                 <th>Ordinamentofieldset</th>*/
/*                 <th>Id</th>*/
/*                 <th>Actions</th>*/
/*             </tr>*/
/*         </thead>*/
/*         <tbody>*/
/*         {% for entity in entities %}*/
/*             <tr>*/
/*                 <td><a href="{{ path('campo_show', { 'id': entity.id }) }}">{{ entity.nome }}</a></td>*/
/*                 <td>{{ entity.descrizione }}</td>*/
/*                 <td>{{ entity.tipo }}</td>*/
/*                 <td>{{ entity.obbligatorioinserzione }}</td>*/
/*                 <td>{{ entity.obbligatoriovalidazione }}</td>*/
/*                 <td>{{ entity.ordinamento }}</td>*/
/*                 <td>{{ entity.fieldset }}</td>*/
/*                 <td>{{ entity.ordinamentofieldset }}</td>*/
/*                 <td>{{ entity.id }}</td>*/
/*                 <td>*/
/*                 <ul>*/
/*                     <li>*/
/*                         <a href="{{ path('campo_show', { 'id': entity.id }) }}">show</a>*/
/*                     </li>*/
/*                     <li>*/
/*                         <a href="{{ path('campo_edit', { 'id': entity.id }) }}">edit</a>*/
/*                     </li>*/
/*                 </ul>*/
/*                 </td>*/
/*             </tr>*/
/*         {% endfor %}*/
/*         </tbody>*/
/*     </table>*/
/* */
/*         <ul>*/
/*         <li>*/
/*             <a href="{{ path('campo_new') }}">*/
/*                 Create a new entry*/
/*             </a>*/
/*         </li>*/
/*     </ul>*/
/*     {% endblock %}*/
/* */
