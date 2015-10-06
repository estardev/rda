<?php

/* estarRdaBundle:Campo:index.html.twig */
class __TwigTemplate_2c7fe25cfccb773b3e97890902d351ff44c9c190333165bd2c8cf87a4857c4d8 extends Twig_Template
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
        $__internal_df192348b3cf729c6c823dfd604f35ef9d679502ac5a93bf4c5875a941056ffc = $this->env->getExtension("native_profiler");
        $__internal_df192348b3cf729c6c823dfd604f35ef9d679502ac5a93bf4c5875a941056ffc->enter($__internal_df192348b3cf729c6c823dfd604f35ef9d679502ac5a93bf4c5875a941056ffc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Campo:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_df192348b3cf729c6c823dfd604f35ef9d679502ac5a93bf4c5875a941056ffc->leave($__internal_df192348b3cf729c6c823dfd604f35ef9d679502ac5a93bf4c5875a941056ffc_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_2e796bcf90fae146a6ddf0f987a504b792957ade19acb6ea8eaf091f0aee7171 = $this->env->getExtension("native_profiler");
        $__internal_2e796bcf90fae146a6ddf0f987a504b792957ade19acb6ea8eaf091f0aee7171->enter($__internal_2e796bcf90fae146a6ddf0f987a504b792957ade19acb6ea8eaf091f0aee7171_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_2e796bcf90fae146a6ddf0f987a504b792957ade19acb6ea8eaf091f0aee7171->leave($__internal_2e796bcf90fae146a6ddf0f987a504b792957ade19acb6ea8eaf091f0aee7171_prof);

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
