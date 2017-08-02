<div id="profile-button-container" class="text-right m-top-20">
    @if($editing)
        @if(isset($nextLink) && $nextLink)
            <a href="{{$nextLink}}" class="btn btn-primary fs-12 btn-lg">Confirm Change</a>
        @else
            <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Update">
        @endif
    @else
        @if($previousUrl)
            <a href="{{$previousUrl}}" class="btn btn-grey fs-12 btn-lg">Previous</a>
        @endif

        @if(isset($nextLink) && $nextLink)
            <a href="{{$nextLink}}" class="btn btn-primary fs-12 btn-lg">Next</a>
        @else
            <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Next">
        @endif
    @endif
</div>
