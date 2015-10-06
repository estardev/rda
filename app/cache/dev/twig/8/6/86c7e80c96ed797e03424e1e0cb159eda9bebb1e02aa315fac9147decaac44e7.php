<?php

/* estarRdaBundle:Documento:index.html.twig */
class __TwigTemplate_2836280656a0378a55db1b54facfa6791fd43d86691a00dfe8be712a0e4d54e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Documento:index.html.twig", 1);
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
        $__internal_a9064582230a425928a79036e58566d286e28749756359b581d4f4fa6567dfbe = $this->env->getExtension("native_profiler");
        $__internal_a9064582230a425928a79036e58566d286e28749756359b581d4f4fa6567dfbe->enter($__internal_a9064582230a425928a79036e58566d286e28749756359b581d4f4fa6567dfbe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Documento:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a9064582230a425928a79036e58566d286e28749756359b581d4f4fa6567dfbe->leave($__internal_a9064582230a425928a79036e58566d286e28749756359b581d4f4fa6567dfbe_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_7d487401f6a02e8bbdcaf87038373c2a764641590136a199b590c3e95a49f332 = $this->env->getExtension("native_profiler");
        $__internal_7d487401f6a02e8bbdcaf87038373c2a764641590136a199b590c3e95a49f332->enter($__internal_7d487401f6a02e8bbdcaf87038373c2a764641590136a199b590c3e95a49f332_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Documento list</h1>

    <table class=\"records_list\">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Id</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["entities"]) ? $context["entities"] : $this->getContext($context, "entities")));
        foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
            // line 17
            echo "            <tr>
                <td><a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("documento_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "nome", array()), "html", null, true);
            echo "</a></td>
                <td>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "descrizione", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
            echo "</td>
                <td>
                <ul>
                    <li>
                        <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("documento_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">show</a>
                    </li>
                    <li>
                        <a href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("documento_edit", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
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
        // line 33
        echo "        </tbody>
    </table>

        <ul>
        <li>
            <a href=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("documento_new");
        echo "\">
                Create a new entry
            </a>
        </li>
    </ul>
    ";
        
        $__internal_7d487401f6a02e8bbdcaf87038373c2a764641590136a199b590c3e95a49f332->leave($__internal_7d487401f6a02e8bbdcaf87038373c2a764641590136a199b590c3e95a49f332_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Documento:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 38,  96 => 33,  84 => 27,  78 => 24,  71 => 20,  67 => 19,  61 => 18,  58 => 17,  54 => 16,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body -%}*/
/*     <h1>Documento list</h1>*/
/* */
/*     <table class="records_list">*/
/*         <thead>*/
/*             <tr>*/
/*                 <th>Nome</th>*/
/*                 <th>Descrizione</th>*/
/*                 <th>Id</th>*/
/*                 <th>Actions</th>*/
/*             </tr>*/
/*         </thead>*/
/*         <tbody>*/
/*         {% for entity in entities %}*/
/*             <tr>*/
/*                 <td><a href="{{ path('documento_show', { 'id': entity.id }) }}">{{ entity.nome }}</a></td>*/
/*                 <td>{{ entity.descrizione }}</td>*/
/*                 <td>{{ entity.id }}</td>*/
/*                 <td>*/
/*                 <ul>*/
/*                     <li>*/
/*                         <a href="{{ path('documento_show', { 'id': entity.id }) }}">show</a>*/
/*                     </li>*/
/*                     <li>*/
/*                         <a href="{{ path('documento_edit', { 'id': entity.id }) }}">edit</a>*/
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
/*             <a href="{{ path('documento_new') }}">*/
/*                 Create a new entry*/
/*             </a>*/
/*         </li>*/
/*     </ul>*/
/*     {% endblock %}*/
/* */
