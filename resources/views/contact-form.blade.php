<form method="post" action="{{ url('/contact') }}">
    {!! csrf_field() !!}
    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" required>
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="3" name="message" placeholder="Your message to us..." required></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>