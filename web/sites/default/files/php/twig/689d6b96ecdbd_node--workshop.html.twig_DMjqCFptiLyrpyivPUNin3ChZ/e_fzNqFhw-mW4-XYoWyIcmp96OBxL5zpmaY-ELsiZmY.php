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

/* themes/custom/flower/templates/content type/node--workshop.html.twig */
class __TwigTemplate_b809ff449c0b06143e2b46fac40b5f4a extends Template
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
        yield "<article";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["node", "node--type-workshop"], "method", false, false, true, 1), "html", null, true);
        yield ">

  <header class=\"workshop-header\">
    <h1>";
        // line 4
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
        yield "</h1>
  </header>

  <div class=\"workshop-banner\">
    ";
        // line 8
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_banner", [], "any", false, false, true, 8)), "html", null, true);
        yield "
  </div>

  <div class=\"workshop-info\">
  <div class=\"info-item\"><i class=\"fa-solid fa-location-dot\"></i> ";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_place", [], "any", false, false, true, 12)), "html", null, true);
        yield "</div>
  <div class=\"info-item\"><i class=\"fa-solid fa-calendar-days\"></i> ";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date", [], "any", false, false, true, 13)), "html", null, true);
        yield "</div>
  <div class=\"info-item\"><i class=\"fa-solid fa-user\"></i> ";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_places_available", [], "any", false, false, true, 14)), "html", null, true);
        yield "</div>
  
  ";
        // line 17
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_domain", [], "any", true, true, true, 17) && Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_domain", [], "any", false, false, true, 17)))) {
            // line 18
            yield "  <div class=\"info-item info-badges\">
    <strong>Domaine :</strong>
    <div class=\"badges\">
      ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_domain", [], "any", false, false, true, 21));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 22
                yield "        ";
                $context["term"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, true, 22);
                // line 23
                yield "        ";
                if ((($tmp = ($context["term"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 24
                    yield "          <span class=\"badge-domain\">
            ";
                    // line 25
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["term"] ?? null), "label", [], "any", false, false, true, 25), "html", null, true);
                    yield "
          </span>
          ";
                    // line 32
                    yield "        ";
                }
                // line 33
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            yield "    </div>
  </div>
";
        }
        // line 37
        yield "
";
        // line 39
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_thematic", [], "any", true, true, true, 39) && Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_thematic", [], "any", false, false, true, 39)))) {
            // line 40
            yield "  <div class=\"info-item info-badges\">
    <strong>Thématique :</strong>
    <div class=\"badges\">
      ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_thematic", [], "any", false, false, true, 43));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 44
                yield "        ";
                $context["term"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, true, 44);
                // line 45
                yield "        ";
                if ((($tmp = ($context["term"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 46
                    yield "          <span class=\"badge-domain\">
            ";
                    // line 47
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["term"] ?? null), "label", [], "any", false, false, true, 47), "html", null, true);
                    yield "
          </span>
          ";
                    // line 54
                    yield "        ";
                }
                // line 55
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            yield "    </div>
  </div>
";
        }
        // line 59
        yield "
  
  <div class=\"info-item\"><i class=\"fa-solid fa-language\"></i> ";
        // line 61
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_language", [], "any", false, false, true, 61)), "html", null, true);
        yield "</div>
  
  <div class=\"info-item difficulty\"><strong>Niveau :</strong> ";
        // line 63
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_difficulty_level", [], "any", false, false, true, 63)), "html", null, true);
        yield "</div>
</div>



  <div class=\"workshop-layout\">
    
    <main class=\"workshop-main\">
      <section class=\"workshop-section\">
        <h2>Présentation</h2>
        ";
        // line 73
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_workshop_presentation", [], "any", false, false, true, 73)), "html", null, true);
        yield "
      </section>

      <section class=\"workshop-section\">
        <h2>Objectifs</h2>
        ";
        // line 78
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_workshop_objectives", [], "any", false, false, true, 78)), "html", null, true);
        yield "
      </section>

      <section class=\"workshop-section\">
        <h2>Intervenants</h2>
        ";
        // line 83
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_speakers", [], "any", false, false, true, 83)), "html", null, true);
        yield "
      </section>

      <section class=\"workshop-section\">
        <h2>Programmes</h2>
        ";
        // line 88
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_program", [], "any", false, false, true, 88)), "html", null, true);
        yield "
      </section>

      <section class=\"workshop-section workshop-location\">
        <h2>Lieu de l’atelier</h2>
        <div class=\"location-description\">
            ";
        // line 94
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_location_description", [], "any", false, false, true, 94)), "html", null, true);
        yield "
        </div>
        <div class=\"location-map\">
            ";
        // line 97
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_location", [], "any", false, false, true, 97)), "html", null, true);
        yield "
        </div>
        </section>

    </main>

    <aside class=\"workshop-aside\">

      ";
        // line 105
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price", [], "any", true, true, true, 105) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price", [], "any", false, false, true, 105)))) {
            // line 106
            yield "        <section class=\"aside-card price-card\">
          ";
            // line 107
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price_scale", [], "any", true, true, true, 107) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price_scale", [], "any", false, false, true, 107)))) {
                // line 108
                yield "            <div class=\"aside-price-scale\">
              ";
                // line 109
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price_scale", [], "any", false, false, true, 109)), "html", null, true);
                yield "
            </div>
          ";
            }
            // line 112
            yield "          <div class=\"aside-price\">
            ";
            // line 113
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_price", [], "any", false, false, true, 113)), "html", null, true);
            yield "
          </div>
            ";
            // line 115
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", true, true, true, 115) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", false, false, true, 115)))) {
                // line 116
                yield "            ";
                $context["lien"] = (($_v0 = (($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", false, false, true, 116)) && is_array($_v1) || $_v1 instanceof ArrayAccess && in_array($_v1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v1[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", false, false, true, 116), 0, [], "array", false, false, true, 116))) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0["#url"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v2 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", false, false, true, 116)) && is_array($_v2) || $_v2 instanceof ArrayAccess && in_array($_v2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v2[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_registration_link", [], "any", false, false, true, 116), 0, [], "array", false, false, true, 116)), "#url", [], "array", false, false, true, 116));
                // line 117
                yield "            <div class=\"aside-cta\">
                <a href=\"";
                // line 118
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["lien"] ?? null), "html", null, true);
                yield "\" class=\"btn-inscription\" target=\"_blank\" rel=\"noopener\">
                Inscription
                </a>
            </div>
            ";
            }
            // line 123
            yield "

        </section>
      ";
        }
        // line 127
        yield "
    

    </aside>
  </div>
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "label", "content", "node"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/flower/templates/content type/node--workshop.html.twig";
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
        return array (  277 => 127,  271 => 123,  263 => 118,  260 => 117,  257 => 116,  255 => 115,  250 => 113,  247 => 112,  241 => 109,  238 => 108,  236 => 107,  233 => 106,  231 => 105,  220 => 97,  214 => 94,  205 => 88,  197 => 83,  189 => 78,  181 => 73,  168 => 63,  163 => 61,  159 => 59,  154 => 56,  148 => 55,  145 => 54,  140 => 47,  137 => 46,  134 => 45,  131 => 44,  127 => 43,  122 => 40,  120 => 39,  117 => 37,  112 => 34,  106 => 33,  103 => 32,  98 => 25,  95 => 24,  92 => 23,  89 => 22,  85 => 21,  80 => 18,  78 => 17,  73 => 14,  69 => 13,  65 => 12,  58 => 8,  51 => 4,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/flower/templates/content type/node--workshop.html.twig", "/var/www/html/web/themes/custom/flower/templates/content type/node--workshop.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 17, "for" => 21, "set" => 22];
        static $filters = ["escape" => 1, "render" => 8, "length" => 17];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'render', 'length'],
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
