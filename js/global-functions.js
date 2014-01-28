function likeNumberFormatter(num)
{
    var handled, suffix;
    if (num > 999 && num <= 999999)
    {
        handled = Math.floor(num/1000);
        suffix = 'K';
    }
    else if (num > 999999)
    {
        handled = Math.floor(num/1000000);
        suffix = 'M';
    }
    else
    {
        handled = num;
        suffix = '';
    }
    return handled + suffix;
}
