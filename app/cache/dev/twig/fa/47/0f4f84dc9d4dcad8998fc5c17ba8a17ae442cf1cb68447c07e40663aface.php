<?php

/* OCPlatformBundle:Advert:menu.html.twig */
class __TwigTemplate_fa470f4f84dc9d4dcad8998fc5c17ba8a17ae442cf1cb68447c07e40663aface extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "  ";
        // line 2
        echo "
  ";
        // line 4
        echo "
  <ul class=\"nav nav-pills nav-stacked\">
    ";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listAdverts"]) ? $context["listAdverts"] : $this->getContext($context, "listAdverts")));
        foreach ($context['_seq'] as $context["_key"] => $context["advert"]) {
            // line 7
            echo "      <li>
        <a href=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("oc_platform_view", array("id" => $this->getAttribute($context["advert"], "id", array()))), "html", null, true);
            echo "\">
          ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["advert"], "title", array()), "html", null, true);
            echo "
        </a>
      </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['advert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "  </ul>
";
    }

    public function getTemplateName()
    {
        return "OCPlatformBundle:Advert:menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 13,  39 => 9,  35 => 8,  32 => 7,  28 => 6,  24 => 4,  21 => 2,  19 => 1,);
    }
}
