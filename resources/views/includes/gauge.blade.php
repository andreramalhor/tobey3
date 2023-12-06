<script>
    var gauge =new JustGage({
        id: "dias-sem-comanda",                                                                                                                   // (string) this is container element id
        // defaults: null,                                                                                                                           // (bool) defaults parameter to use
        // parentNode: null,                                                                                                                         // (node object) this is container element
        value: {{ $dias }},                                                                                                                       // (int) value gauge is showing
        // width: 600,                                                                                                                               // (int) gauge width
        height: 150,                                                                                                                              // (int) gauge height
        // valueFontColor: '{{ $color }}',                                                                                                           // (string) color of label showing current value
        valueFontFamily: "Source Sans Pro",                                                                                                       // (string) color of label showing current value
        // symbol: ' dias',                                                                                                                          // (string) special symbol to show next to value
        min: 0,                                                                                                                                   // (int) min value
        minTxt: '0',                                                                                                                              // (string) min value text
        max: 100,                                                                                                                                 // (int) max value
        maxTxt: '90 dias',                                                                                                                        // (string) min value text
        reverse: false,                                                                                                                           // (bool) min value text
        // humanFriendlyDecimal: 2,                                                                                                                  // (int) number of decimal places for our human friendly number to contain
        
        // textRenderer: kvLookup('textRenderer', config, dataset, null),                                                                            // (func) function applied before rendering text
        // onAnimationEnd: kvLookup('onAnimationEnd', config, dataset, null),                                                                        // (func) function applied after animation is done
        // gaugeWidthScale: kvLookup('gaugeWidthScale', config, dataset, 1.0),                                                                       // (float) width of the gauge element
        // gaugeColor: kvLookup('gaugeColor', config, dataset, "#edebeb"),                                                                           // (string) cor do gauge do fundo, sem estar preenchido
        label: 'dias',                                                                                                                            // (string) texto que fica em baixo do valor
        labelFontColor: 'black',                                                                                                                  // (string) cor dos textos de legenda (inicio, valor e fim)
        labelFontFamily: "Source Sans Pro",                                                                                                       // (string) font-family dos textos de legenda
        // shadowOpacity: kvLookup('shadowOpacity', config, dataset, 0.2),                                                                           // (int) shadowOpacity 0 ~ 1
        // shadowSize: kvLookup('shadowSize', config, dataset, 5),                                                                                   // (int) inner shadow size
        // shadowVerticalOffset: kvLookup('shadowVerticalOffset', config, dataset, 3),                                                               // (int) how much shadow is offset from top
        levelColors: ["#28a745", "#ffc107", "#dc3545"],                                                                                           // (string[]) colors of indicator, from lower to upper, in RGB format
        // startAnimationTime: kvLookup('startAnimationTime', config, dataset, 700),                                                                 // (int) length of initial animation
        // startAnimationType: kvLookup('startAnimationType', config, dataset, '>'),                                                                 // (string) type of initial animation (linear, >, <,  <>, bounce)
        // refreshAnimationTime: kvLookup('refreshAnimationTime', config, dataset, 700),                                                             // (int) length of refresh animation
        // refreshAnimationType: kvLookup('refreshAnimationType', config, dataset, '>'),                                                             // (string) type of refresh animation (linear, >, <,  <>, bounce)
        // donutStartAngle: kvLookup('donutStartAngle', config, dataset, 90),                                                                        // (int) angle to start from when in donut mode
        // valueMinFontSize: kvLookup('valueMinFontSize', config, dataset, 16),                                                                      // (int) absolute minimum font size for the value
        // labelMinFontSize: kvLookup('labelMinFontSize', config, dataset, 10),                                                                      // (int) absolute minimum font size for the label
        // minLabelMinFontSize: kvLookup('minLabelMinFontSize', config, dataset, 10),                                                                // (int) absolute minimum font size for the minimum label
        // maxLabelMinFontSize: kvLookup('maxLabelMinFontSize', config, dataset, 10),                                                                // (int) absolute minimum font size for the maximum label
        // hideValue: kvLookup('hideValue', config, dataset, false),                                                                                 // (bool) hide value text
        // hideMinMax: kvLookup('hideMinMax', config, dataset, false),                                                                               // (bool) hide min and max values
        // showInnerShadow: kvLookup('showInnerShadow', config, dataset, false),                                                                     // (bool) show inner shadow
        // humanFriendly: kvLookup('humanFriendly', config, dataset, false),                                                                         // (bool) convert large numbers for min, max, value to human friendly (e.g. 1234567 -> 1.23M)
        // noGradient: kvLookup('noGradient', config, dataset, false),                                                                               // (bool) whether to use gradual color change for value, or sector-based
        // donut: kvLookup('donut', config, dataset, false),                                                                                         // (bool) show full donut gauge
        // relativeGaugeSize: kvLookup('relativeGaugeSize', config, dataset, false),                                                                 // (bool) whether gauge size should follow changes in container element size
        // counter: kvLookup('counter', config, dataset, false),                                                                                     // (bool) animate level number change
        // decimals: kvLookup('decimals', config, dataset, 0),                                                                                       // (int) number of digits after floating point
           
        // // customSectors : object
        // // percents : bool hi/lo are percents values
        // // ranges : array of objects : {hi, lo, color}
        // customSectors: kvLookup('customSectors', config, dataset, {}),                                                                            // custom sectors colors. Expects an object with props
        
        // formatNumber: kvLookup('formatNumber', config, dataset, false),                                                                           // (boolean) formats numbers with commas where appropriate
        pointer: true,                                                                                                                            //  (bool) show value pointer
        // differential: true,                                                                                                                       // min must = -max and pointer will be at top when = 0
        // pointerOptions: kvLookup('pointerOptions', config, dataset, {}),                                                                          // (object) define pointer look
        // displayRemaining: kvLookup('displayRemaining', config, dataset, false)                                                                    // (boolean) replace display number with the number remaining to reach max
    });
</script>