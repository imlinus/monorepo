function common.find_index(tbl, prop)
  for i, o in ipairs(tbl) do
    if o[prop] then
      return i
    end
  end
end

