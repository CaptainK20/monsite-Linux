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

/* modules/contrib/splide/templates/splide.html.twig */
class __TwigTemplate_eac2c7acbf66340e044672615caf1885 extends Template
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
            'splide_content' => [$this, 'block_splide_content'],
            'splide_progress' => [$this, 'block_splide_progress'],
            'splide_autoplay' => [$this, 'block_splide_autoplay'],
            'splide_arrow' => [$this, 'block_splide_arrow'],
            'splide_pagination' => [$this, 'block_splide_pagination'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 37
        $context["classes"] = [(((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 38
($context["splides"] ?? null), "is", [], "any", false, false, true, 38), "unsplide", [], "any", false, false, true, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("unsplide") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 39
($context["blazies"] ?? null), "is", [], "any", false, false, true, 39), "nav", [], "any", false, false, true, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("splide--" . \Drupal\Component\Utility\Html::getClass(($context["display"] ?? null)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 40
($context["settings"] ?? null), "skin", [], "any", false, false, true, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("splide--skin--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "skin", [], "any", false, false, true, 40)))) : ("")), ((CoreExtension::inFilter("boxed", CoreExtension::getAttribute($this->env, $this->source,         // line 41
($context["settings"] ?? null), "skin", [], "any", false, false, true, 41))) ? ("splide--skin--boxed") : ("")), ((CoreExtension::inFilter("split", CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["settings"] ?? null), "skin", [], "any", false, false, true, 42))) ? ("splide--skin--split") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 43
($context["settings"] ?? null), "optionset", [], "any", false, false, true, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("splide--optionset--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "optionset", [], "any", false, false, true, 43)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 44
($context["splides"] ?? null), "transition", [], "any", false, false, true, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("splide--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["splides"] ?? null), "transition", [], "any", false, false, true, 44)))) : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 45
($context["settings"] ?? null), "perPage", [], "any", false, false, true, 45) > 1)) ? ("is-carousel") : ("is-slider")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 46
($context["settings"] ?? null), "fullwidth", [], "any", false, false, true, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-fullwidth") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 47
($context["blazies"] ?? null), "count", [], "any", false, false, true, 47) <= CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "perPage", [], "any", false, false, true, 47))) ? ("is-less") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["settings"] ?? null), "vertical", [], "any", false, false, true, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-vertical") : ("")), ((((        // line 49
($context["display"] ?? null) == "main") && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 49))) ? (("is-" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 49)))) : ("")), ((((        // line 50
($context["display"] ?? null) == "nav") && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "nav_caption", [], "any", false, false, true, 50))) ? ("is-captioned") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 51
($context["settings"] ?? null), "skin_arrows", [], "any", false, false, true, 51) || array_key_exists("arrow_down_attributes", $context))) ? ("is-arrowed") : ("")), ((        // line 52
array_key_exists("arrow_down_attributes", $context)) ? ("is-arrowed--down") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 53
($context["settings"] ?? null), "skin_arrows", [], "any", false, false, true, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("is-arrowed--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "skin_arrows", [], "any", false, false, true, 53)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 54
($context["splides"] ?? null), "use", [], "any", false, false, true, 54), "autoplay", [], "any", false, false, true, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-autoplay") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 55
($context["settings"] ?? null), "autoscroll", [], "any", false, false, true, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-autoscroll") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 56
($context["settings"] ?? null), "pagination", [], "any", false, false, true, 56)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-paginated") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 57
($context["settings"] ?? null), "pagination_fx", [], "any", false, false, true, 57)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("is-paginated--fx-" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "pagination_fx", [], "any", false, false, true, 57)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 58
($context["settings"] ?? null), "pagination_tab", [], "any", false, false, true, 58)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-paginated--tab") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 59
($context["settings"] ?? null), "pagination_pos", [], "any", false, false, true, 59)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("is-paginated--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "pagination_pos", [], "any", false, false, true, 59)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 60
($context["settings"] ?? null), "skin_dots", [], "any", false, false, true, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("is-paginated--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "skin_dots", [], "any", false, false, true, 60)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 61
($context["settings"] ?? null), "attributes", [], "any", false, false, true, 61), "class", [], "any", false, false, true, 61)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::join(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "attributes", [], "any", false, false, true, 61), "class", [], "any", false, false, true, 61), " ")) : (""))];
        // line 64
        yield "<div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 64), "html", null, true);
        yield ">";
        // line 65
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["splides"] ?? null), "use", [], "any", false, false, true, 65), "slider", [], "any", false, false, true, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 66
            yield "<div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["splide__slider"], "method", false, false, true, 66), "html", null, true);
            yield ">";
        }
        // line 69
        yield from $this->unwrap()->yieldBlock('splide_content', $context, $blocks);
        // line 74
        yield "
  ";
        // line 79
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["splides"] ?? null), "use", [], "any", false, false, true, 79), "progress", [], "any", false, false, true, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 80
            yield from $this->unwrap()->yieldBlock('splide_progress', $context, $blocks);
        }
        // line 84
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["splides"] ?? null), "use", [], "any", false, false, true, 84), "autoplay", [], "any", false, false, true, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 85
            yield from $this->unwrap()->yieldBlock('splide_autoplay', $context, $blocks);
        }
        // line 93
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["splides"] ?? null), "use", [], "any", false, false, true, 93), "slider", [], "any", false, false, true, 93)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 94
            yield "</div>";
        }
        // line 97
        yield from $this->unwrap()->yieldBlock('splide_arrow', $context, $blocks);
        // line 106
        yield "  ";
        yield from $this->unwrap()->yieldBlock('splide_pagination', $context, $blocks);
        // line 109
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["splides", "blazies", "display", "settings", "arrow_down_attributes", "attributes", "content_attributes", "list_attributes", "items", "arrows_attributes", "pagination_attributes"]);        yield from [];
    }

    // line 69
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 70
        yield "    <div class=\"splide__track\">
      <ul";
        // line 71
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["list_attributes"] ?? null), "html", null, true);
        yield ">";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["items"] ?? null), "html", null, true);
        yield "</ul>
    </div>
  ";
        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_progress(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 81
        yield "      <div class=\"splide__progress\"><div class=\"splide__progress__bar\"></div></div>
    ";
        yield from [];
    }

    // line 85
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_autoplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 86
        yield "      <button class=\"splide__toggle\" type=\"button\" aria-controls=\"toggle-track\" aria-label=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Pause autoplay"));
        yield "\">
        <svg class=\"splide__toggle__play\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"m22 12-20 11v-22l10 5.5z\"></path></svg>
        <svg class=\"splide__toggle__pause\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"m2 1v22h7v-22zm13 0v22h7v-22z\"></path></svg>
      </button>
    ";
        yield from [];
    }

    // line 97
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_arrow(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 98
        yield "    <div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["arrows_attributes"] ?? null), "html", null, true);
        yield "></div>";
        // line 99
        if (array_key_exists("arrow_down_attributes", $context)) {
            // line 100
            yield "<button";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["arrow_down_attributes"] ?? null), "addClass", ["splide__arrow--down"], "method", false, false, true, 100), "setAttribute", ["type", "button"], "method", false, false, true, 100), "setAttribute", ["data-target", CoreExtension::getAttribute($this->env, $this->source,             // line 102
($context["settings"] ?? null), "downTarget", [], "any", false, false, true, 102)], "method", false, false, true, 101), "setAttribute", ["data-offset", CoreExtension::getAttribute($this->env, $this->source,             // line 103
($context["settings"] ?? null), "downOffset", [], "any", false, false, true, 103)], "method", false, false, true, 102), "html", null, true);
            yield "></button>";
        }
        yield from [];
    }

    // line 106
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_splide_pagination(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 107
        yield "    <ul";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["pagination_attributes"] ?? null), "html", null, true);
        yield "></ul>
  ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/splide/templates/splide.html.twig";
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
        return array (  199 => 107,  192 => 106,  185 => 103,  184 => 102,  182 => 100,  180 => 99,  176 => 98,  169 => 97,  158 => 86,  151 => 85,  145 => 81,  138 => 80,  128 => 71,  125 => 70,  118 => 69,  111 => 109,  108 => 106,  106 => 97,  103 => 94,  101 => 93,  98 => 85,  96 => 84,  93 => 80,  91 => 79,  88 => 74,  86 => 69,  81 => 66,  79 => 65,  75 => 64,  73 => 61,  72 => 60,  71 => 59,  70 => 58,  69 => 57,  68 => 56,  67 => 55,  66 => 54,  65 => 53,  64 => 52,  63 => 51,  62 => 50,  61 => 49,  60 => 48,  59 => 47,  58 => 46,  57 => 45,  56 => 44,  55 => 43,  54 => 42,  53 => 41,  52 => 40,  51 => 39,  50 => 38,  49 => 37,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/splide/templates/splide.html.twig", "/var/www/html/web/modules/contrib/splide/templates/splide.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 37, "if" => 65, "block" => 69];
        static $filters = ["clean_class" => 39, "join" => 61, "escape" => 64, "t" => 86];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'join', 'escape', 't'],
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
