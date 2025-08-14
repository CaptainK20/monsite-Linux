<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/flower/templates/content type/node--conference.html.twig */
class __TwigTemplate_56df1d9e0a70cd34c3d94b1f52ac6862 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<article class=\"conference-detail\">

  ";
        // line 4
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_banner", [], "any", false, false, true, 4))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 5
            yield "    <div class=\"conference-banner\">
      ";
            // line 6
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_banner", [], "any", false, false, true, 6), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 9
        yield "
  <div class=\"conference-meta\">
    ";
        // line 12
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date", [], "any", false, false, true, 12))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 13
            yield "      <div class=\"conference-field\">
        <strong>Date :</strong> ";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date", [], "any", false, false, true, 14), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 17
        yield "
    ";
        // line 19
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_place", [], "any", false, false, true, 19))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "      <div class=\"conference-field\">
        <strong>Lieu :</strong> ";
            // line 21
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_place", [], "any", false, false, true, 21), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 24
        yield "
    ";
        // line 26
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_language", [], "any", false, false, true, 26))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 27
            yield "      <div class=\"conference-field\">
        <strong>Langue :</strong> ";
            // line 28
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_language", [], "any", false, false, true, 28), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 31
        yield "
    ";
        // line 33
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_difficulty_level", [], "any", false, false, true, 33))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 34
            yield "      <div class=\"conference-field\">
        <strong>Niveau :</strong> ";
            // line 35
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_difficulty_level", [], "any", false, false, true, 35), "html", null, true);
            yield "
      </div>
    ";
        }
        // line 38
        yield "  </div>

  ";
        // line 41
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_description", [], "any", false, false, true, 41))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 42
            yield "    <div class=\"conference-section\">
      <strong>Description :</strong>
      ";
            // line 44
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_description", [], "any", false, false, true, 44), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 47
        yield "
  ";
        // line 49
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_domain", [], "any", false, false, true, 49))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 50
            yield "    <div class=\"conference-section\">
      <strong>Domaines :</strong>
      ";
            // line 52
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_domain", [], "any", false, false, true, 52), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 55
        yield "
  ";
        // line 57
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_thematic", [], "any", false, false, true, 57))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 58
            yield "    <div class=\"conference-section\">
      <strong>Thématiques :</strong>
      ";
            // line 60
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_thematic", [], "any", false, false, true, 60), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 63
        yield "
  ";
        // line 65
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_speakers", [], "any", false, false, true, 65))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 66
            yield "    <div class=\"conference-section\">
      <strong>Intervenants :</strong>
      ";
            // line 68
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_speakers", [], "any", false, false, true, 68), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 71
        yield "
  ";
        // line 73
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_document", [], "any", false, false, true, 73))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 74
            yield "    <div class=\"conference-section\">
      <strong>Document :</strong>
      ";
            // line 76
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_document", [], "any", false, false, true, 76), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 79
        yield "
  ";
        // line 81
        yield "  ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_link", [], "any", false, false, true, 81))))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 82
            yield "    <div class=\"conference-section\">
      <a href=\"";
            // line 83
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v0 = (($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_link", [], "any", false, false, true, 83)) && is_array($_v1) || $_v1 instanceof ArrayAccess && in_array($_v1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v1[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_link", [], "any", false, false, true, 83), 0, [], "array", false, false, true, 83))) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0["#url"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v2 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_link", [], "any", false, false, true, 83)) && is_array($_v2) || $_v2 instanceof ArrayAccess && in_array($_v2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v2[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_link", [], "any", false, false, true, 83), 0, [], "array", false, false, true, 83)), "#url", [], "array", false, false, true, 83)), "html", null, true);
            yield "\" target=\"_blank\" class=\"conference-link\">
        En savoir plus
      </a>
    </div>
  ";
        }
        // line 88
        yield "
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/flower/templates/content type/node--conference.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  219 => 88,  211 => 83,  208 => 82,  205 => 81,  202 => 79,  196 => 76,  192 => 74,  189 => 73,  186 => 71,  180 => 68,  176 => 66,  173 => 65,  170 => 63,  164 => 60,  160 => 58,  157 => 57,  154 => 55,  148 => 52,  144 => 50,  141 => 49,  138 => 47,  132 => 44,  128 => 42,  125 => 41,  121 => 38,  115 => 35,  112 => 34,  109 => 33,  106 => 31,  100 => 28,  97 => 27,  94 => 26,  91 => 24,  85 => 21,  82 => 20,  79 => 19,  76 => 17,  70 => 14,  67 => 13,  64 => 12,  60 => 9,  54 => 6,  51 => 5,  48 => 4,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/flower/templates/content type/node--conference.html.twig", "/var/www/html/web/themes/custom/flower/templates/content type/node--conference.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 4];
        static $filters = ["trim" => 4, "render" => 4, "escape" => 6];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['trim', 'render', 'escape'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
