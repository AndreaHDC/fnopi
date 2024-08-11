/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */
  app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .entry('editorscripts', ['@scripts/editor'])
    .assets(['images']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
  app.setPublicPath('/wp-content/themes/fnopi-theme/public/');

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/reference/bud.setUrl}
   * @see {@link https://bud.js.org/reference/bud.setProxyUrl}
   * @see {@link https://bud.js.org/reference/bud.watch}
   */
  app
    .setUrl('http://localhost:3000')
    .setProxyUrl('https://fnopi.test')
    .watch(['resources/views', 'app']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setSettings({
      background: {
        backgroundImage: true,
      },
      layout: {
        contentSize: '1700px',
        wideSize: '1920px'
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        padding: true,
        margin:true,
        units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
      },
      typography: {
        customFontSize: false,
      },
    })

    .set('styles.elements.button.typography.fontWeight', '700')
    .set('styles.elements.button.spacing.padding.top', '0')
    .set('styles.elements.button.spacing.padding.bottom', '0')
    .set('styles.elements.button.spacing.padding.left', '0')
    .set('styles.elements.button.spacing.padding.right', '0')
    .set('styles.elements.button.border.radius.topLeft', '0')
    .set('styles.elements.button.border.radius.topRight', '0')
    .set('styles.elements.button.border.radius.bottomLeft', '0')
    .set('styles.elements.button.border.radius.bottomRight', '0')
    .set('styles.elements.button.color.background', 'transparent')
    .set('styles.elements.button.color.text', 'var(--wp--preset--color--fnopi-green)')
    

    .useTailwindColors()
    .useTailwindFontFamily()
    .useTailwindFontSize();
};
