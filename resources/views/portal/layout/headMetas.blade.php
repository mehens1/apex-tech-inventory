<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<link rel="shortcut icon" href="{{ asset('assets/img/logo-small.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<style type="text/css">
    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 100;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 200;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 400;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 500;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 600;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 700;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 800;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic-ext/wght/normal.woff2);
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek/wght/normal.woff2);
        unicode-range: U+0370-03FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/vietnamese/wght/normal.woff2);
        unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/cyrillic/wght/normal.woff2);
        unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin/wght/normal.woff2);
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/latin-ext/wght/normal.woff2);
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        font-display: swap;
    }

    @font-face {
        font-family: Inter;
        font-style: normal;
        font-weight: 900;
        src: url({{ asset('') }}assets/cf-fonts/v/inter/5.0.16/greek-ext/wght/normal.woff2);
        unicode-range: U+1F00-1FFF;
        font-display: swap;
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script src="{{asset('assets/js/layout.js')}}" type="b724b34a6fd7605f339218b4-text/javascript"></script>
