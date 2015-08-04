<?php

/* OCCoreBundle:Core:index.html.twig */
class __TwigTemplate_e82156cf8d6a4be7cb532c45ebb9fa52e4ce534d860f9e79b00a90c21df7e55f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("OCCoreBundle::layout.html.twig", "OCCoreBundle:Core:index.html.twig", 2);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "OCCoreBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "  Page d'accueil - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        // line 9
        echo "
  <h2>Page d'accueil de notre site</h2>

  ";
        // line 13
        echo "  ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "info"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 14
            echo "    <div class=\"alert alert-info\">Message flash : ";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "
  ";
        // line 18
        echo "  <h3>Dernières annonces</h3>
  ";
        // line 19
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("OCPlatformBundle:Advert:menu", array("limit" => 3)));
        echo "

  <h3>Derniers messages sur le forum (hypothétique)</h3>
  <p>
    ";
        // line 25
        echo "    Bla bla bla...
  </p>

";
    }

    public function getTemplateName()
    {
        return "OCCoreBundle:Core:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 25,  67 => 19,  64 => 18,  61 => 16,  52 => 14,  47 => 13,  42 => 9,  39 => 8,  32 => 5,  29 => 4,  11 => 2,);
    }
}
