```SCSS
# Scss Grid Systems demo
.bears-row{
    display: block;
    margin: -15px; 
    width: calc(100% + 30px);
    &:after{
        content: "";
        clear: both;
        display: block;
    }
    [class*="bears-col-"]{
        padding: 0 15px;
        float: left;
        box-sizing: border-box;
    }
    @for $i from 1 through 12 {
        .bears-col-#{$i}{
            width: calc(100% / (12 / #{$i}));
        }
    }
    @media (max-width: 979px) {
        @for $i from 1 through 12 {
            .bears-md-col-#{$i}{
                width: calc(100% / (12 / #{$i}));
            }
        }
    }
    @media (max-width: 767px) {
        @for $i from 1 through 12 {
            .bears-sm-col-#{$i}{
                width: calc(100% / (12 / #{$i}));
            }
        }
    }
}
```