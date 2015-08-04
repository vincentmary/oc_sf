<?php

/* OCCoreBundle::layout.html.twig */
class __TwigTemplate_44407fae06d4cf8952c771636cefa9b3ce980bfe001fd57bac65b92ba2b574e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<!DOCTYPE html>
<html>
<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

  <title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

  ";
        // line 11
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 15
        echo "</head>

<body>
  <div class=\"container\">
    <div id=\"header\" class=\"jumbotron\">
      <h1>Ma plateforme d'annonces</h1>
      <p>
        Ce projet est propulsé par Symfony2,
        et construit grâce au MOOC OpenClassrooms et SensioLabs.
      </p>
      <p>
        <a class=\"btn btn-primary btn-lg\" href=\"http://fr.openclassrooms.com/informatique/cours/developpez-votre-site-web-avec-le-framework-symfony2\">
          Participer au MOOC »
        </a>
      </p>
    </div>

    <div class=\"row\">
      <div id=\"menu\" class=\"col-md-3\">
        <h3>Les annonces</h3>
        <ul class=\"nav nav-pills nav-stacked\">
          <li><a href=\"";
        // line 36
        echo $this->env->getExtension('routing')->getPath("oc_platform_home");
        echo "\">Accueil</a></li>
          ";
        // line 37
        if ($this->env->getExtension('security')->isGranted("ROLE_AUTEUR")) {
            // line 38
            echo "            <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("oc_platform_add");
            echo "\">Ajouter une annonce</a></li>
          ";
        }
        // line 40
        echo "        </ul>

        <h4>Dernières annonces</h4>
        ";
        // line 43
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("OCPlatformBundle:Advert:menu", array("limit" => 3)));
        echo "
      </div>
      <div id=\"content\" class=\"col-md-9\">
        ";
        // line 46
        $this->displayBlock('body', $context, $blocks);
        // line 48
        echo "      </div>
    </div>

    <hr>

    <footer>
      <p>The sky's the limit © ";
        // line 54
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " and beyond.</p>
    </footer>
  </div>

  ";
        // line 58
        $this->displayBlock('javascripts', $context, $blocks);
        // line 63
        echo "
</body>
</html>";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo "OC Plateforme";
    }

    // line 11
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        // line 13
        echo "    <link rel=\"stylesheet\" href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">
  ";
    }

    // line 46
    public function block_body($context, array $blocks = array())
    {
        // line 47
        echo "        ";
    }

    // line 58
    public function block_javascripts($context, array $blocks = array())
    {
        // line 59
        echo "    ";
        // line 60
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js\"></script>
  ";
    }

    public function getTemplateName()
    {
        return "OCCoreBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 60,  136 => 59,  133 => 58,  129 => 47,  126 => 46,  121 => 13,  119 => 12,  116 => 11,  110 => 9,  104 => 63,  102 => 58,  95 => 54,  87 => 48,  85 => 46,  79 => 43,  74 => 40,  68 => 38,  66 => 37,  62 => 36,  39 => 15,  37 => 11,  32 => 9,  23 => 2,);
    }
}
