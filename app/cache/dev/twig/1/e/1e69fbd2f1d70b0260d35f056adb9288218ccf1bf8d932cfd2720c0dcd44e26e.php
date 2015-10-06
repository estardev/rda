<?php

/* estarRdaBundle:Categoria:index.html.twig */
class __TwigTemplate_f8c15730018f7cf7185a33daab8f06710b4e00cf44d3ecf8b8ce18abee55dc80 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "estarRdaBundle:Categoria:index.html.twig", 1);
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
        $__internal_a3b6f899aff31fb42f47d266c268622e7cb2bab5961f8eba395869c77083fde9 = $this->env->getExtension("native_profiler");
        $__internal_a3b6f899aff31fb42f47d266c268622e7cb2bab5961f8eba395869c77083fde9->enter($__internal_a3b6f899aff31fb42f47d266c268622e7cb2bab5961f8eba395869c77083fde9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "estarRdaBundle:Categoria:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a3b6f899aff31fb42f47d266c268622e7cb2bab5961f8eba395869c77083fde9->leave($__internal_a3b6f899aff31fb42f47d266c268622e7cb2bab5961f8eba395869c77083fde9_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_96f4e98583c69c8e6997a94b4f553dca706582be7a293da7a7064f0fb1d59315 = $this->env->getExtension("native_profiler");
        $__internal_96f4e98583c69c8e6997a94b4f553dca706582be7a293da7a7064f0fb1d59315->enter($__internal_96f4e98583c69c8e6997a94b4f553dca706582be7a293da7a7064f0fb1d59315_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<h1>Categoria list</h1>

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
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("categoria_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
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
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("categoria_show", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
            echo "\">show</a>
                    </li>
                    <li>
                        <a href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("categoria_edit", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
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
        echo $this->env->getExtension('routing')->getPath("categoria_new");
        echo "\">
                Create a new entry
            </a>
        </li>
    </ul>
    ";
        
        $__internal_96f4e98583c69c8e6997a94b4f553dca706582be7a293da7a7064f0fb1d59315->leave($__internal_96f4e98583c69c8e6997a94b4f553dca706582be7a293da7a7064f0fb1d59315_prof);

    }

    public function getTemplateName()
    {
        return "estarRdaBundle:Categoria:index.html.twig";
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
/*     <h1>Categoria list</h1>*/
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
/*                 <td><a href="{{ path('categoria_show', { 'id': entity.id }) }}">{{ entity.nome }}</a></td>*/
/*                 <td>{{ entity.descrizione }}</td>*/
/*                 <td>{{ entity.id }}</td>*/
/*                 <td>*/
/*                 <ul>*/
/*                     <li>*/
/*                         <a href="{{ path('categoria_show', { 'id': entity.id }) }}">show</a>*/
/*                     </li>*/
/*                     <li>*/
/*                         <a href="{{ path('categoria_edit', { 'id': entity.id }) }}">edit</a>*/
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
/*             <a href="{{ path('categoria_new') }}">*/
/*                 Create a new entry*/
/*             </a>*/
/*         </li>*/
/*     </ul>*/
/*     {% endblock %}*/
/* */
