<?php

/* OCPlatformBundle:Advert:form.html.twig */
class __TwigTemplate_7da76e9d9c8e26cf965730450f8752025f337431531f71cc66ffee60b11bd11f extends Twig_Template
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
        // line 2
        echo "
";
        // line 4
        echo "<div class=\"well\">
    ";
        // line 5
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
</div>

";
        // line 10
        echo "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>

";
        // line 13
        echo "<script type=\"text/javascript\">
    \$(document).ready(function() {
        // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
        var \$container = \$('div#oc_platformbundle_advert_categories');

        // On ajoute un lien pour ajouter une nouvelle catégorie
        var \$addLink = \$('<a href=\"#\" id=\"add_category\" class=\"btn btn-default\">Ajouter une catégorie</a>');
        \$container.append(\$addLink);

        // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
        \$addLink.click(function(e) {
            addCategory(\$container);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });

        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = \$container.find(':input').length;

        // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
        if (index == 0) {
            addCategory(\$container);
        } else {
            // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
            \$container.children('div').each(function() {
                addDeleteLink(\$(this));
            });
        }

        // La fonction qui ajoute un formulaire Categorie
        function addCategory(\$container) {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
            // - le texte \"__name__label__\" qu'il contient par le label du champ
            // - le texte \"__name__\" qu'il contient par le numéro du champ
            var \$prototype = \$(\$container.attr('data-prototype').replace(/__name__label__/g, 'Catégorie n°' + (index+1))
                    .replace(/__name__/g, index));

            // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
            addDeleteLink(\$prototype);

            // On ajoute le prototype modifié à la fin de la balise <div>
            \$container.append(\$prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;
        }

        // La fonction qui ajoute un lien de suppression d'une catégorie
        function addDeleteLink(\$prototype) {
            // Création du lien
            \$deleteLink = \$('<a href=\"#\" class=\"btn btn-danger\">Supprimer</a>');

            // Ajout du lien
            \$prototype.append(\$deleteLink);

            // Ajout du listener sur le clic du lien
            \$deleteLink.click(function(e) {
                \$prototype.remove();
                e.preventDefault(); // évite qu'un # apparaisse dans l'URL
                return false;
            });
        }
    });
</script>";
    }

    public function getTemplateName()
    {
        return "OCPlatformBundle:Advert:form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 13,  31 => 10,  25 => 5,  22 => 4,  19 => 2,);
    }
}
