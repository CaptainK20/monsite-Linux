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

/* modules/contrib/splide/templates/splide-slide.html.twig */
class __TwigTemplate_c810c63bdf2d09d7e713f65f62d5ecfd extends Template
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
            'splide_slide' => [$this, 'block_splide_slide'],
            'splide_caption' => [$this, 'block_splide_caption'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 21
        $context["classes"] = [("slide--" .         // line 22
($context["delta"] ?? null)), ((Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source,         // line 23
($context["item"] ?? null), "slide", [], "any", false, false, true, 23))) ? ("slide--text") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 24
($context["settings"] ?? null), "layout", [], "any", false, false, true, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("slide--caption--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "layout", [], "any", false, false, true, 24)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 25
($context["settings"] ?? null), "class", [], "any", false, false, true, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "class", [], "any", false, false, true, 25)) : (""))];
        // line 29
        $context["content_classes"] = [(((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 30
($context["settings"] ?? null), "detroy", [], "any", false, false, true, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("slide") : ("")), (((($tmp =  !CoreExtension::getAttribute($this->env, $this->source,         // line 31
($context["settings"] ?? null), "detroy", [], "any", false, false, true, 31)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("slide__content") : (""))];
        // line 35
        $context["caption_classes"] = ["slide__caption"];
        // line 39
        $context["use_blazy"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 39), "theme_blazy", [], "any", false, false, true, 39);
        // line 40
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "wrapper", [], "any", false, false, true, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 41
            yield "<li";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 41), "html", null, true);
            yield ">";
        }
        // line 44
        if ((($tmp = ($context["use_blazy"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 45
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["item"] ?? null), "html", null, true);
        } else {
            // line 47
            yield "    ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "use_ca", [], "any", false, false, true, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [($context["content_classes"] ?? null)], "method", false, false, true, 51), "html", null, true);
                yield ">";
            }
            // line 52
            $context["slide"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 53
                yield "        ";
                yield from $this->unwrap()->yieldBlock('splide_slide', $context, $blocks);
                // line 60
                yield "      ";
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 62
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "slide", [], "any", false, false, true, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 63
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["slide"] ?? null), "html", null, true);
            }
            // line 66
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 66)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 67
                yield from $this->unwrap()->yieldBlock('splide_caption', $context, $blocks);
            }
            // line 98
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "use_ca", [], "any", false, false, true, 98)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "</div>";
            }
        }
        // line 101
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "wrapper", [], "any", false, false, true, 101)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 102
            yield "</li>";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["delta", "item", "settings", "blazies", "attributes", "content_attributes", "caption_attributes"]);        yield from [];
    }

    // line 53
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_slide(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 54
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "split", [], "any", false, false, true, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 55
            yield "<div class=\"slide__media\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "slide", [], "any", false, false, true, 55), "html", null, true);
            yield "</div>
          ";
        } else {
            // line 57
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "slide", [], "any", false, false, true, 57), "html", null, true);
        }
        yield from [];
    }

    // line 67
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_caption(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 68
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "fullwidth", [], "any", false, false, true, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<div class=\"slide__constrained\">";
        }
        // line 70
        yield "<div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["caption_attributes"] ?? null), "addClass", [($context["caption_classes"] ?? null)], "method", false, false, true, 70), "html", null, true);
        yield ">";
        // line 71
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 71), "overlay", [], "any", false, false, true, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 72
            yield "<div class=\"slide__overlay\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 72), "overlay", [], "any", false, false, true, 72), "html", null, true);
            yield "</div>";
            // line 73
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "data", [], "any", false, false, true, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<div class=\"slide__data\">";
            }
        }
        // line 76
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 76), "title", [], "any", false, false, true, 76)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 77
            yield "<h2 class=\"slide__title\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 77), "title", [], "any", false, false, true, 77), "html", null, true);
            yield "</h2>";
        }
        // line 80
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 80), "alt", [], "any", false, false, true, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 81
            yield "<p class=\"slide__description\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 81), "alt", [], "any", false, false, true, 81), "html", null, true);
            yield "</p>";
        }
        // line 84
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 84), "data", [], "any", false, false, true, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 85
            yield "<div class=\"slide__description\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 85), "data", [], "any", false, false, true, 85), "html", null, true);
            yield "</div>";
        }
        // line 88
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 88), "link", [], "any", false, false, true, 88)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 89
            yield "<div class=\"slide__link\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 89), "link", [], "any", false, false, true, 89), "html", null, true);
            yield "</div>";
        }
        // line 92
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "caption", [], "any", false, false, true, 92), "overlay", [], "any", false, false, true, 92) && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "data", [], "any", false, false, true, 92))) {
            yield "</div>";
        }
        // line 93
        yield "</div>";
        // line 95
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "fullwidth", [], "any", false, false, true, 95)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "</div>";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/splide/templates/splide-slide.html.twig";
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
        return array (  194 => 95,  192 => 93,  188 => 92,  183 => 89,  181 => 88,  176 => 85,  174 => 84,  169 => 81,  167 => 80,  162 => 77,  160 => 76,  155 => 73,  151 => 72,  149 => 71,  145 => 70,  141 => 68,  134 => 67,  128 => 57,  122 => 55,  120 => 54,  113 => 53,  106 => 102,  104 => 101,  99 => 98,  96 => 67,  94 => 66,  91 => 63,  89 => 62,  85 => 60,  82 => 53,  80 => 52,  74 => 51,  72 => 47,  69 => 45,  67 => 44,  62 => 41,  60 => 40,  58 => 39,  56 => 35,  54 => 31,  53 => 30,  52 => 29,  50 => 25,  49 => 24,  48 => 23,  47 => 22,  46 => 21,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/splide/templates/splide-slide.html.twig", "/var/www/html/web/modules/contrib/splide/templates/splide-slide.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 21, "if" => 40, "block" => 53];
        static $filters = ["clean_class" => 24, "escape" => 41];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'escape'],
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
